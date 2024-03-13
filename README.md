# 3AM Content Elements Page - Build Content Elements Page Automatically

Are you tired of manually creating content elements pages on your TYPO3 website? Introducing our innovative TYPO3 extension that simplifies the process by automatically generating a dedicated page containing all unique content elements present across your site.

With our extension, you can say goodbye to the tedious task of individually crafting content element pages. Instead, our solution scans your TYPO3 website, identifies all distinct content elements, and dynamically compiles them into a single, organized page.

## Installation

Install extension with composer `composer req threeam/threeam-content-elements-page`.

## How It Works

The Content Elements Page extension operates by querying the entire database for content elements based on specific criteria, including CType, list_type, layout, and frame_class. These criteria are essential for identifying unique combinations of content elements across your TYPO3 installation.

### Querying Content Elements

1. **Identification Parameters:** The extension searches for content elements based on their CType (Content Type), list_type, layout, and frame_class.

2. **Unique Combinations:** By analyzing these parameters, Content Elements Page identifies unique combinations of content elements existing within the TYPO3 database.

### Scheduler Integration

Content Elements Page seamlessly integrates with TYPO3's scheduler functionality to automate the process of updating content elements.

1. **Scheduled Execution:** When configured as a scheduler task, the extension periodically checks for updates to content elements.

2. **Duplicate Checking:** Before copying content elements to a page, Content Elements Page verifies if a similar combination already exists on the target page.

3. **Efficient Updates:** If an identical combination is found, the extension skips the copy process, ensuring that only new or modified content elements are added to the page.

### Benefits for Editors

By utilizing Content Elements Page within TYPO3's environment, editors can experience several advantages:

- **Efficiency:** Editors can quickly find and select the correct content elements needed to construct new pages, saving time and effort.
  
- **Accuracy:** With automated updates, pages remain up-to-date with the latest content elements, ensuring consistency across the website.

- **Streamlined Workflow:** The seamless integration with TYPO3's scheduler simplifies content management tasks, allowing editors to focus on creating engaging content.

## Configuration
Setup page id in extension configuration to the id where you want to place all content elements

## Usage
Create a scheduler of type console command  for `cepage:build` or you can execute from cli with `cepage:build`

## Credits

This extension is created by [3AM Technolgies](https://3am-tech.com).
