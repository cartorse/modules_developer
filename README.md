# Modules Developer

PrestaShop 9 module to manage and display all modules from a specific developer/author.

## Features

- Configuration field to set the developer/author name
- Access Developer Modules page from Modules → Modules Developer configuration
- Display all modules from the configured developer in card format
- Shows module name, version, description, author, and installation status
- Quick access to manage modules from the developer

## Installation

1. Place the `modules_developer` folder in your PrestaShop `modules/` directory
2. Go to PrestaShop BackOffice → Modules → Module Manager
3. Search for "Modules Developer" and click Install
4. Click "Configure" button on the module
5. Enter the developer/author name you want to filter by
6. Click Save
7. Click "View modules" to see all modules from that developer

## Usage

After installation and configuration:

1. Go to Modules → Modules Developer → Configure
2. The page displays all modules whose author matches the configured name
3. Each module is displayed as a card showing:
   - Display name
   - Version
   - Author
   - Technical name
   - Description
   - Installation status (Installed / Not Installed)
4. Click "Manage" button to access individual module configuration

## Structure

```
modules_developer/
├── modules_developer.php                           # Main module class
├── config.xml                                      # Module metadata
├── controllers/
│   └── admin/
│       └── AdminDeveloperModulesController.php    # Admin controller (legacy)
├── views/
│   └── templates/
│       └── admin/
│           ├── developer_modules.tpl              # Modules list template
│           └── no_config.tpl                      # No config template
├── translations/
│   └── es.json                                    # Spanish translations
├── logo.png                                       # Module logo
└── README.md                                      # This file
```

## Module Details

- **Version**: 1.0.0
- **Author**: Suma Y Sube
- **Compatibility**: PrestaShop 9.0.0+
- **Type**: Administration module
- **Tab**: Administration

## Configuration

The module stores the developer/author name in the configuration key:
`MODULES_DEVELOPER_AUTHOR_NAME`

This value is used to filter modules by their author field in `config.xml`.
