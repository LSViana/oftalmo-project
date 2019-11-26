# Software Manager

This software was designed and created to allow the user to manage softwares across multiple rooms (called "laboratories" around here).

There are multiple levels of permissions to read and write data from the system, besides that the object orientation approach wasn't used in the whole application.

## Levels of permissions

Different features are available accordingly to the user's level of authorization, which are the following:

  * No authorization (anonymous): you won't be able to read and write anything to/from the system;
  * Regular: you can only read data from the system;
  * Administrator: you can read and write from/to the system.

## Object orientation coverage

The object orientation features were used mostly in the scripts under the directory `data`, which are responsible for all the I/O operations during requests.

Scripts under directories `api` (for API), `pages` and `components` (for Views) and `infrastructure` (for reusable scripts not involved directly with business rules) weren't rebuilt to work with object orientation because they are mostly used to import variables into scope for further use (like the HTTP Request Method used).