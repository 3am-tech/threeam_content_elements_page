<?php

declare(strict_types=1);

namespace Threeam\ThreeamContentElementsPage\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;

class BuildContentElementsPage extends Command
{
    protected function configure(): void
    {
        $this->setDescription('TYPO3 extension that simplifies the process by automatically generating a dedicated page containing all unique content elements present across your site.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
        
        $config = $extensionConfiguration->get('threeam_content_elements_page');
        if(!$config['cePageId']) {
            $output->writeln('Target Content Elements page id not set');
            return Command::FAILURE;
        }

        $queryBuilder1 = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
        $queryBuilder1->getRestrictions()
        ->removeByType(HiddenRestriction::class);
        $existingContentElements = $queryBuilder1
            ->select('CType', 'list_type', 'layout', 'frame_class')
            ->from('tt_content')
            ->where(
                    $queryBuilder1->expr()->eq('pid', $queryBuilder1->createNamedParameter($config['cePageId'], \PDO::PARAM_INT))
                )
                ->executeQuery()
                ->fetchAllAssociative();
            
        $queryBuilder2 = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
        $result = $queryBuilder2
            ->resetQueryParts()
            ->select('uid', 'CType', 'list_type', 'layout', 'frame_class')
            ->from('tt_content')
            ->groupBy('CType')
            ->addGroupBy('list_type')
            ->addGroupBy('layout')
            ->addGroupBy('frame_class')
            ->orderBy('tstamp', 'DESC')
            ->execute();

        // Retrieve the unique content elements
        $cmd = [];
        $count = 1;
        while ($row = $result->fetchAssociative()) {
            $subset = $row;
            unset($subset['uid']);
            // do not insert element again if its already on content elements page
            if (!$this->isSubsetOfArray([$subset], $existingContentElements)) {
                $cmd['tt_content'][$row['uid']]['copy'] = $config['cePageId'];
                $output->writeln($count . ' -> ' .$row['uid'] . ' -> Content Element added to page ' . $config['cePageId']);
                $count++;
            }
        }
        \TYPO3\CMS\Core\Core\Bootstrap::initializeBackendAuthentication();
        $dataHandler = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\DataHandling\DataHandler::class);
        $dataHandler->start([], $cmd);
        $dataHandler->process_cmdmap();
        if ($dataHandler->errorLog !== []) {
            foreach ($dataHandler->errorLog as $log) {
                $output->writeln($log);
            }
        }
        return Command::SUCCESS;
    }

    /**
     * Checks if the given subset is a subset of the main array.
     *
     * @param array $subset The subset to be checked
     * @param array $mainArray The main array to be checked against
     * @return bool Returns true if the subset is a subset of the main array, otherwise false
     */
    function isSubsetOfArray($subset, $mainArray) {
        foreach ($subset as $subElement) {
            $foundMatch = false;
            foreach ($mainArray as $mainElement) {
                if ($subElement === $mainElement) {
                    $foundMatch = true;
                    break;
                }
            }
            if (!$foundMatch) {
                // As soon as one element is not found, return false.
                return false;
            }
        }
        // All elements were found.
        return true;
    }
}
