# toggleTVSet
Toggle a set of TVs depending on the value of a Single Select TV

This plugin will toggle the visibility of a number of TVs depending on the value of a select TV.

**Use case**

You want to be able to pick one of four different headers.
Each type of header needs one or more TVs but you only want to show the TVs needed for the selected type of header.
Each type of header will use a different chunk for templating.

** Warning:  At the moment this plugin only works with TVs displayed on the TV tab.
If you are using form customization to move your TVs to another tab, this plugin will not work.
A later version will be more versatile. **

---

# Setup

At tthe moment you have to manually setup the plugin. Just follow the steps below.

## Step 1 - Create your header TVs

### Simple Header TV

* Header_Headline (6) - a simple Text TV

### Jumbotron TVs

* Jumbotron_Background_Color (7) - Colorpicker TV
* Jumbotron_Background_Image (8) - Image TV
* Jumbotron_RTE (9) - Richtext TV

### Carousel TVs

* Carousel_Gallery (10) - MIGX TV

### Cover TVs

* Cover_Background_Image (11) - Image TV
* Cover_RTE (12) - Richtext TV

### Header Select TV

Header (13) - Single Select TV
* Input Option Values:"Standard==6||Jumbotron==7,8,9||Carousel==10||Cover==11,12"
* Allow Blank: false
* Default: 4
* Enable typeahead: false

Give each input option a label and add the ids of the TVs used as comma separated values.

** Note: **  Be careful not to add empty spaces inside the value!

```
Bad: "Jumbotron== 1, 2, 3 "
Good: "Jumbotron==1,2,3"
```

## Step 2 - Add toogleTVSet to your MODx Manager.

1. Copy the code found in ** core/components/ppb_toggletvset/elements/plugins/toggletvset.plugin.php ** into to a new plugin and trigger it on ** OnDocFormPreRender **.
2. Modify the selectTV variable in line 40 to match the id of your Header Select TV.
3. Done.



