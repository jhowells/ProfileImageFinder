# ProfileImageFinder
Profile Image Finder Project


This project simply returns the URL of an image based on an email address and displays the image. There is a lot of
other information that could be displayed, but that's beyond the scope of this project.


NOTES:

I am deploying on my local machine using MAMP on a Mac Pro, but the results would be the same in any environment. For
development/testing, I am using php 5.5.26, but I don't think the results would be different for any version of PHP
starting with version 5.

The API Key comes from an environment variable. Methods of storing environment variables vary from platform to
platform. For MAMP the variable is stored in /Applications/MAMP/Library/bin/envvars.

Results are cached using $_SESSION variables.


INSTALLATION:

If installing in a local environment, just place the ProfileImageFinder directory in the document root for whichever
server you are using. In the case of MAMP, the root directory goes in /Applicartions/MAMP/htdocs.


SOME POSSIBLE IMPROVEMENTS:

1. Allow the user to pick from several different image finder services from a dropdown in the form. By default,
   select FullContact.

2. Currently the primary image is chosen, but in the cases where multiple images are available, allow the user to
   choose from the array after retrieving, or allow the option of passing in the preferred avatar from various
   locations, such as Facebook, LinkedIn, Google, etc.


John Howells
howells@punkhart.com
