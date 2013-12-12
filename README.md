# LandQuest Kenya JEO Child Theme

### Map data

Information displayed on the map is editable at this Google Docs Spreadsheet:

https://docs.google.com/spreadsheet/ccc?key=0AudTRqkrNLbcdDh2XzdYeEExamFXUnNYN3k0N25iakE&usp=sharing

The application is avaliable in English and Spanish, and every column that can be translated has two columns aside refering to these languages. For example, OXFAM Hand Dug Wells has columns titled "Functioning" and "Operativo". Each one describes in English and Spanish if the well is in operation.

The spreadsheet structure (columns titles, order of tabs) shouldn't be changed as this will break translation functionality. Adding new records without changing the sheet layout is fine.

### How to install

This is a child theme of JEO, a Wordpress theme which enables map publishing. 

Download it and install at your `wp-content` folder:

https://github.com/cardume/jeo

Then, copy this repository (LandQuest) to `wp-content`. You should be able to activate LandQuest theme at admin panel.

### Setup

Enable translations:

* Install qTranslate plugin
* At the advanced settings page, check "Use strftime instead of date and replace formats with the predefined formats for each language." for "Date / Time Conversion" option.

Fetch map data from Google Docs:

* While logged, hit 'Update data from Google Docs' in the top toolbar;
