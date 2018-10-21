# k3-table-field
K3 plugin. A very simple table editor. No expanding views, no modals. Just edit a table of strings. 

## Install
Download the latest release from the [Releases tab](https://github.com/rasteiner/k3-table-field/releases). 
Unzip the contents into a new folder in your `site/plugins` folder.

## Use
1. Use the field type `table`
2. Set the columns as a `key:label` object. 

### Example

```yaml
fields:
  mytable:
    label: My table
    type: table
    columns:
      name: First Name
      surname: Last Name
      age: Age
```
