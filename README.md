# CMSMS Optimizer

Image compression tool.

## How to use

1. Put source files in the *plugins* folder
2. Call plugin in code with `{optimizer}`, example below:

Example:
`{image_url src="{$fileSrc}" type="image" assign="convertedImg" width=380 height=500 quality=90}`

## Available parameters

- **src** *[required]*: source link to the file (you can use {root_url} or another Smarty variables)
- **type** *[default = image]*: type of optimized file (image/~~video~~/~~pdf~~)
- **assign**: allows you to assign a compressed file to a variable, *displays in the place where the code is called if not completed*
- **width** *[default = 360]*: width of converted file *only available for image/~~video~~ type*
- **height** *[default = 480]*: height of converted file *only available for image/~~video~~ type*
- **compression quality** *[default = 90]*: compression quality *scale between 10-100*
- **watermark**: centered text, protect the photo against copying

### Functions:

- image compression
- video compression (soon)
- PDF compression (soon)
- watermark (soon)

## Version history

- **0.2**: file savings works, added image creation mechanics
- **0.1**: configuration, the file does not work yet