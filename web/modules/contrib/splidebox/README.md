
# <a name="top"> </a>CONTENTS OF THIS FILE

 * [Introduction](#introduction)
 * [Requirements](#requirements)
 * [Installation](#installation)
 * [Configuration](#configuration)
 * [Features](#features)
 * [Lightbox optionset & skin](#optionset)
 * [Troubleshooting](#troubleshooting)
 * [Maintainers](#maintainers)

***
***
# <a name="introduction"></a>INTRODUCTION

Splide, the vanilla JavaScript slider, within lightbox.

***
## <a name="first"> </a>FIRST THINGS FIRST!
Read more at:
* [Github](https://git.drupalcode.org/project/blazy/-/blob/3.0.x/docs/README.md#first-things-first)
* [Blazy UI](/admin/help/blazy_ui#first)

***
***
# <a name="requirements"> </a>REQUIREMENTS
* [Blazy](https://drupal.org/project/blazy)
* [Splide](https://drupal.org/project/splide)


***
***
# <a name="installation"> </a>INSTALLATION
Install the module as usual, more info can be found on:

[Installing Drupal 8 Modules](https://drupal.org/node/1897420)


***
***
# <a name="configuration"> </a>CONFIGURATION
Enable this module, Splide and its dependency, core image and Blazy modules.

## FIELD FORMATTERS
* **/admin/config/people/accounts/fields**, or **/admin/structure/types**,
  or any fieldable entity, click **Manage display**.
* Under **Format**, choose blazy-related formatters:
  **Blazy**, **Splide**, etc. for image, media, paragraphs fields.
* Click the **Configure** icon.
* Under **Media switcher**, choose **Image to Splidebox**. Adjust the rest.

## BLAZY FILTER
* **/admin/config/content/formats/full_html**, etc.
* Enable **Blazy Filter**.
* Under **Media switcher**, choose **Image to Splidebox**.

## VIEWS
* `/admin/structure/views`
* See Blazy module docs under `USAGES` for more details with lightboxes.

***
***
# <a name="features"></a>FEATURES
* Has no formatter, instead integrated into **Media switcher** option as seen at
  Blazy/ Splide formatters, including Blazy Views fields for File Entity and
  Media, and also Blazy Filter for inline images.
* Swipeable remote video for core Media module.
* (Responsive|Picture) image, local audio/video, soundcloud, SVG, data URI, etc.
* AJAX contents.


***
***
# <a name="optionset"></a>SPLIDEBOX OPTIONSET & SKIN
Enable Splide UI sub-module first, otherwise regular **Access denied**.
We only have one optionset for the Splidebox, override it accordingly:

**/admin/config/media/splide/list/splidebox/edit**

You can select a skin you registered yourself under `Skin` option here. To
register skins, check out [Splide FAQ](/admin/help/splide_ui#faq) about `Skins`.

The default skin for lightbox is `Skyblue`, the original library theme.
Other themes aren't tested, and may require relevant adjustments as usual.

For the sample alters, see `splidebox_blazy_attach_alter()` at splidebox.module.

***
***
## SIMILAR MODULES
[Slick Lightbox](https://drupal.org/project/slick_lightbox)

***
***
## KNOWN ISSUES/ LIMITATIONS
* Update 2023/08/09: the nested splidebox is possible, but might have issues.
* Nested splidebox is not currently supported, that is when you have AJAX
  content via Splidebox which have links or images which also launches another
  Splidebox.  
  **Solutions**: refactor your design to avoid nested Splidebox. Or use other
  lightboxes as the inner lightbox if you had to. Intense module works fine.


***
***
# <a name="maintainers"> </a>MAINTAINERS/CREDITS
* [Gaus Surahman](https://drupal.org/user/159062)
* [Contributors](https://www.drupal.org/node/3216403/committers)
* CHANGELOG.txt for helpful souls with their patches, suggestions and reports.
* Inspired by PhotoSwipe and Slick Lightbox, the code was totally different, and
  mostly taking advantage of Splide's own library API.


## READ MORE
See the project page on drupal.org:

[Splidebox module](https://drupal.org/project/splidebox)
[Splidebox help](/admin/help/splidebox)
