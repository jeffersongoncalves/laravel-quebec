# Changelog

All notable changes to this project will be documented in this file.

## 2.0.0 - 2026-11-18

### Breaking

- The engine moves to [laravel-privacy](https://github.com/jeffersongoncalves/laravel-privacy), the base shared by the LGPD, GDPR, CCPA, US privacy and Quebec suites. Every class of this package keeps its name and now extends its `JeffersonGoncalves\Privacy` base. If you extend one of them, check your overrides.

### Unchanged

- Config keys, tables, migrations, commands, events and the `#[PersonalData]` declarations: apps need no change.

### Added

- Suites installed side by side (e.g. LGPD and GDPR) only see their own declarations and events.

## 1.0.0 - 2026-11-17

First release of laravel-quebec, the core of a Laravel toolkit for Quebec's Act respecting the protection of personal information in the private sector, as amended by Law 25.

- Declare personal information on your Eloquent models with `#[PersonalData]`: purpose, sensitive information (s. 12), communication outside Quebec (s. 17), technology that identifies, locates or profiles (s. 8.1), retention and strategy.
- Inventory, export (access and portability, s. 27) and destruction or anonymization (s. 23).
- k-anonymity check with generalizers, as a facade method and an Artisan command.

## [Unreleased]
