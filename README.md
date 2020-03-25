# uk.co.mountev.teamapproval

Notify team members when team status gets Approved (Team Details > Status).

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v5.6+
* CiviCRM v5.x

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl uk.co.mountev.teamapproval@https://github.com/mountev/uk.co.mountev.teamapproval/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/mountev/uk.co.mountev.teamapproval.git
cv en teamapproval
```

## Usage

- Make sure activity type 'Team Status Approved' exists. An activity gets created everytime a team gets Approved (Team Details > Status).
- Create a new message template for notification that will be used for notifying all team members.
- Setup scheduled reminder from activities of type 'Team Status Approved' with tokens {contact.current_employer}, and {contactk2b.team_number}.
- Make sure reminder cron is enabled.
