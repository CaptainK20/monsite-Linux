# Glossify

The Glossify module provides filters that scans and parses content and
terms in the text and allows adding links and tooltips to them.
It consists of 2 filters, one for taxonomy and one for content.

For a full description of the module, visit the
[project page](https://www.drupal.org/project/glossify).

Submit bug reports and feature suggestions, or track changes in the
[issue queue](https://www.drupal.org/project/issues/glossify).


## Table of contents

- Requirements
- Installation
- Configuration
- Maintainers


## Requirements

This module requires no modules outside of Drupal core.


## Installation

You need to install both the Glossify module itself, but also Glossify Node
Tooltips or Glossify Taxonomy Tooltips.

Install as you would normally install a contributed Drupal module. For further
information, see
[Installing Drupal Modules](https://www.drupal.org/docs/extending-drupal/installing-drupal-modules).


## Configuration

The filters included in the module can work on content or terms.

### Glossify with taxonomy

Links taxonomy terms appearing in content to their taxonomy term page.
select which taxonomy vocabularies to use as the source for the terms.
indicate whether or not matching is case sensitive.
indicate whether or not every match should be linked or just the first
occurrence. display the term definition as a tooltip while hovering the
glossified link.

### Glossify with content

Links node titles of content appearing in other content to their node page.
select which content types to use as the source for the terms.
indicate whether or not matching is case sensitive.
indicate whether or not every match should be linked or just the first
occurrence. display the text from a selected field on the linked node as a
tooltip while hovering the glossified link.

### Alter glossify nodes / terms query

You can alter the "Glossify: Tooltips with nodes" (`glossify_node`) and
"Glossify: Tooltips with taxonomy" (`glossify_taxonomy`) filter processing
queries through implementing `hook_query_TAG_alter()`.
This allows you to exclude and add nodes / terms using clauses and expressions.

(The hook names are `MODULE_query_glossify_node_tooltip_alter()` and 
`MODULE_query_glossify_taxonomy_tooltip_alter()` respectively)

#### Usage examples

```php
/**
 * Implements hook_query_TAG_alter().
 */
function MODULE_query_glossify_taxonomy_tooltip_alter(Drupal\Core\Database\Query\AlterableInterface $query) {
  // Include only term where boolean "field_exclude_from_glossary" field is FALSE or not NULL.
  $query->leftJoin('taxonomy_term__field_exclude_from_glossary', 't__feg', 't__feg.entity_id=tfd.tid');
  $query->condition(
    $query->orConditionGroup()
      ->condition('t__feg.field_exclude_from_glossary_value', 0)
      ->isNull('t__feg.field_exclude_from_glossary_value')
  );
  // Include only terms with name "Choose me".
  $query->condition('tfd.name', 'Choose me');
}
```

### Enable term or content filter

1. Go to Administration » Configuration » Content authoring » Text formats
   and editors
2. Edit a text format, for example "Basic HTML"
3. Enable a Glossify filter and configure it under "Filter settings"

### Exclude terms from filter processing

1. Wrap the relevant text (Term name or Node title) in a element with
   'glossify-exclude' class within the specified formatted text instance.
   Example: "<span class="glossify-exclude">text</span>".
2. Tip: The CKEditor 5 / CKEditor Style plugin allows users to apply predefined styles
   to their text, so glossary-exclude can be added as needed to exclude certain
   terms from being glossified in specific instances:

   - Go to /admin/config/content/formats
   - Configure concerning text format where the class should be applied.
   - Ensure that CKEditor 5 / CKEditor is selected as the editor.
   - In the Editor Plugins section, confirm that the Style plugin is enabled.
   - Add your custom style definition under the Styles plugin configuration.
     Example: `p.glossary-exclude|Exclude from glossary`

## Maintainers

Current maintainers:

- Stefan Auditor - [sanduhrs](https://www.drupal.org/u/sanduhrs)
- Julian Pustkuchen - [Anybody](https://www.drupal.org/u/Anybody)
- keesje - [keesje](https://www.drupal.org/u/keesje)
- WorldFallz - [worldfallz](https://www.drupal.org/u/worldfallz) 
- Kobus Beljaars - [beljaako](https://www.drupal.org/u/beljaako)
- Joshua Sedler - [Grevil](https://www.drupal.org/u/Grevil)
