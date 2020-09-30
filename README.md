# CMSMS Optimizer

Image compression tool.

## How it works?

1. Put source files in the *plugins* folder
2. Call plugin in code with `{optimizer}`, example below:

Example:
`{image_url src="/img/silesia.jpg" type="image" assign="converted" height=500 quality=75}`

Plugin compresses the photo, saves them to a new location and returns the link to the compressed one.
Link: `uploads/optimizer/silesia-auto-500-75.jpg`
Plugin generates the photo 

## Available parameters

- **src** *[required]*: source link to the file (you can use {root_url} or another Smarty variables)
- **type** *[default = image]*: type of optimized file (image/~~video~~/~~pdf~~)
- **dir** *[default = uploads/optimizer]*: path where the new file should be created
- **assign**: allows you to assign a compressed file to a variable, *displays in the place where the code is called if not completed*
- **width** *[default = auto]*: width of converted file *only available for image/~~video~~ type*
- **height** *[default = auto]*: height of converted file *only available for image/~~video~~ type*
- **compression quality** *[default = 90]*: compression quality *scale between 10-100*
- ~~**watermark**: centered text, protect the photo against copying~~
- ~~**preffix**: adds a text to the beginning of the filename ~~
- ~~**affix**: adds a text to the end of the filename (before params)~~
- ~~**notag**: *(bool)* set to return the link itself (true) or the img tag (false) ~~
- ~~**title**: *only if notag == false*~~
- ~~**alt**: *only if notag == false*~~

### Functions:

- image compression
- video compression (soon)
- PDF compression (soon)
- watermark (soon)

## Version history

- **0.2**: file savings works, added image creation mechanics
- **0.1**: configuration, the file does not work yet