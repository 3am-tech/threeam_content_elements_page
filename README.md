# 3AM Content Elements Page - Build Content Elements Page Automatically

Are you tired of manually creating content elements pages on your TYPO3 website? Introducing our innovative TYPO3 extension that simplifies the process by automatically generating a dedicated page containing all unique content elements present across your site.

With our extension, you can say goodbye to the tedious task of individually crafting content element pages. Instead, our solution scans your TYPO3 website, identifies all distinct content elements, and dynamically compiles them into a single, organized page.

## Installation

Install extension with composer `composer req threeam/threeam-content-elements-page`.

## Configuration
Setup page id in extension configuration to the id where you want to place all content elements

## Usage
Create a scheduler of type console command  for `cepage:build` or you can execute from cli with `cepage:build`


