<?php

namespace JeffersonGoncalves\Quebec;

use JeffersonGoncalves\Privacy\Generalize as BaseGeneralize;

/**
 * Generalizers for quasi-identifiers: each returns a closure that coarsens a value
 * (null stays null), for Quebec::kAnonymity() or for building an anonymized dataset.
 */
final class Generalize extends BaseGeneralize {}
