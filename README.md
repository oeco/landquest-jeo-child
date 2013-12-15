# LandQuest Kenya JEO Child Theme

## Install

Download and expand [JEO theme](http://cardume.github.io/jeo) files in your Wordpress `wp-content/themes` directory. Repeat same steps for [Landquest child theme](https://github.com/oeco/landquest-jeo-child/archive/master.zip) files. Go to `Appearance` tab in Wordpress Admin and set `Landquest` as your theme.

Then, enable translations:

* Install qTranslate plugin
* At the advanced settings page, check "Use strftime instead of date and replace formats with the predefined formats for each language." for "Date / Time Conversion" option.

Populate map data from Google Docs:

* While logged, hit 'Update data from Google Docs' in the top toolbar;

## Setup

### Partners and creator logos at footer bar

In WP admin area go to `Partners` tab and click `Add new`. You will be able to set `Title`, `URL` and `Featured Image`.

### Map data

Information displayed on the map is editable at this Google Docs Spreadsheet:

https://docs.google.com/spreadsheet/ccc?key=0AudTRqkrNLbcdDh2XzdYeEExamFXUnNYN3k0N25iakE&usp=sharing

The application is avaliable in English and Spanish, and every column that can be translated has two columns aside refering to these languages. For example, OXFAM Hand Dug Wells has columns titled "Functioning" and "Operativo". Each one describes in English and Spanish if the well is in operation.

The spreadsheet structure (columns titles, order of tabs) shouldn't be changed as this will break translation functionality. Adding new lines without changing sheet structure add points to the map.
