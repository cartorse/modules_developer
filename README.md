# Modules Developer

A PrestaShop 9 back-office module that lists all installed modules from a specific author/developer, displayed as an informational card grid.

## Features

- Configuration field to set the target developer/author name
- Card grid displaying all matching modules with key metadata
- Shows module technical name, display name, version, description, author, and installation status
- Equal-height cards with responsive layout (3 columns on desktop, 2 on tablet, 1 on mobile)
- Quick access to module configuration from each card

## Requirements

- PrestaShop 9.0.0 or higher
- PHP 7.4 or higher

## Installation

1. Upload the `modules_developer` folder to your PrestaShop `/modules/` directory
2. Go to **Back Office → Modules → Module Manager**
3. Search for "Modules Developer" and click **Install**
4. Click **Configure**
5. Enter the author name you want to filter by and click **Save**

## Usage

After configuring the author name, the module's configuration page will display a card for each installed module whose `author` field (in `config.xml`) matches the configured value. The match is case-insensitive and supports partial strings.

Each card shows:

| Field | Source |
|-------|--------|
| Display name | `config.xml → displayName` |
| Version | `config.xml → version` |
| Author | `config.xml → author` |
| Technical name | Module folder name |
| Description | `config.xml → description` |
| Status | Whether the module is currently installed |

## Project Structure

```
modules_developer/
├── modules_developer.php                        # Main module class
├── config.xml                                   # Module metadata
├── views/
│   └── templates/
│       └── admin/
│           └── developer_modules.tpl            # Card grid template
└── translations/
    └── es.json                                  # Spanish translations
```

## Configuration Key

The author name is stored under the configuration key `MODULES_DEVELOPER_AUTHOR_NAME` and is removed automatically on uninstall.

## License

MIT
