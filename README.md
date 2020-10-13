![CMSMS Optimizer](https://raw.githubusercontent.com/ErykSikora/file-optimizer/master/optimizer/optimizer.png)

# CMSMS Optimizer

Image compression tool.

## How it works?

1. Put source files in the *plugins* folder
2. Call plugin in code with `{optimizer}`, example below:

Example:
`{optimizer src="/img/silesia.jpg" type="image" assign="converted" height=500 quality=75}`

Plugin compresses the photo, saves them to a new location and returns the link to the compressed one.
Link: `uploads/optimizer/silesia-auto-500-75.jpg`
Plugin generates the photo 

## Available parameters

- **type** *[default = image]*: type of optimized file (image/~~video~~/~~pdf~~)
- **src** *[required]*: source link to the file (you can use {root_url} or another Smarty variables)
- **assign**: allows you to assign a compressed file to a variable, *displays in the place where the code is called if not completed*
- **dir** *[default = uploads/optimizer]*: path where the new file should be created
- **width** *[default = auto]*: width of converted file *only available for image/~~video~~ type*
- **height** *[default = auto]*: height of converted file *only available for image/~~video~~ type*
- **quality** *[default = 90]*: compression quality *scale between 10-100*
- ~~**watermark**: centered text, protect the photo against copying~~
- ~~**prefix**: adds a text to the beginning of the filename~~
- ~~**affix**: adds a text to the end of the filename (before params)~~
- **notag**: *(bool) [default = true]* set to return the link itself (true) or the img tag (false)
- **title**: sets the title *only if notag == false*
- **alt**: sets the alternative text value *only if notag == false*

### Functions:

- image compression *1.0*
- watermark (soon - *2.0*) 
- video compression (soon - *3.0*)
- PDF compression (soon - *4.0*)

### Requirements

|               |Version                        |
|---------------|-------------------------------|
|CMSMS          |>= 2.6.x                       |
|PHP            |>= 7.x                         |

> **Note:** There's a possibility to convert for use outside of CMSMS:
> - extract out of smarty function `function smarty_function_xxx`
> - replace *$smarty->assign* method to simple *return* and use this function to assign to your own variable

## Version history

- **0.4**: mechanics assign, fixes, testing, preparing for the release 1.0
- **0.3**: added validation (stop execution if file exists), added function definitions that may not appear in PHP
- **0.2**: file savings works, added image creation mechanics
- **0.1**: configuration, the file does not work yet