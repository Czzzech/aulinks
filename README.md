# aulinks

http://perevozniy.000webhostapp.com/ - DEMO!

http://perevozniy.000webhostapp.com/web/dayside/ - online code viewer(password '123');

test events system

Calendar of meetings.

Create a calendar where you can schedule meetings or events.

Main features:
- Authorization. +
- Registration through invitations. +
- Сreating an event +
- View information about an event. +
- Deleting an event. +
- Moving(drag-and-drop) events to another date. +
- Changing(expanding) the date range of the event (using drag-n-drop). +
- Event should have status - new, in-progress, done. +

Events should have:
- name
- date
- time
- description
- Author
- Status
- color scheme (colorpicker) +

This system should be "One Page website" all actions should use AJAX. +

This system should have two groups of users - the administrator, users.
New member can register using invite link received in email. Only administrator can send invites to e-mail.

The administrator has full access to all events - he can update and/or remove any events.

Users can view the details of all events from all users. Editing and deleting are possible only for their own events.

Basic requirements: PHP 5.6 and higher + PostgreSQL / MySQL. There are no restrictions on frameworks / systems / libraries.
The project must be fully operational. The installation / launch of the project must be simply, with a minimum of actions.



Technoglogies:
AngularJS(front),
Yii2(back),
MySQL,
Bootstrap,
ui-calendar,
a lot of ui-friendly libraries

Realized single-page application with Yii2 RESTfull api.
Here you can see the real demo  - http://perevozniy.000webhostapp.com/

To implement project on your server you must do next:
1. Configure back/config/web.php - emailer;
2. Configure back/config/db.php - database;
3. Allow server to do external connections(to send emails);
4. Import into database database.sql.
