# k3-table-field
K3 plugin. A very simple table editor. No expanding views, no modals. Just edit a table of strings (or checkboxes or selects). 

## Install
### Download Zip file
Download the latest release from the [Releases tab](https://github.com/rasteiner/k3-table-field/releases). 
Unzip the contents into a new folder in your `site/plugins` folder.

### Composer
Run `composer require rasteiner/k3-table-field`.

This will download the latest release from https://github.com/rasteiner-dist/k3-table-field

### Clone this repo
You could also clone this repository, you should do this only if you intend to change the source code.  
Note however that it won't contain compiled JS and CSS files.
You need to build them yourself with either `npm run dev` or `npm run build`. 

## Use
1. Use the field type `table`
2. Define the property `columns` as a `key:definition` object. 

`definition` depends on what type of form element you want.  

- For simple textfields it's simply the label for the column. 
- For checkboxes it's an object with the properties `label` and `type` (which should be `checkbox`)
- For selects it's an object with the properties:
  - `label`
  - `type`: which should be `select`)
  - `options`: which should be an object with `value:label` properties

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
      alive:
        label: Alive
        type: checkbox
      gender:
        label: Gender
        type: select
        options:
          f: Female
          m: Male
```
