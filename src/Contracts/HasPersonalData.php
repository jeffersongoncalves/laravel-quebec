<?php

namespace JeffersonGoncalves\Quebec\Contracts;

use JeffersonGoncalves\Privacy\Contracts\HasPersonalData as BaseHasPersonalData;
use JeffersonGoncalves\Quebec\Attributes\PersonalData;

interface HasPersonalData extends BaseHasPersonalData
{
    /**
     * @return list<PersonalData>
     */
    public static function personalDataFields(): array;

    /**
     * Declared personal data of this record, keyed by column (access, s. 27, including the structured, commonly used technological format).
     *
     * @return array<string, mixed>
     */
    public function exportPersonalData(): array;

    /**
     * Apply each column's anonymize strategy and persist (destruction or anonymization once the purposes are achieved, s. 23).
     */
    public function anonymizePersonalData(): void;
}
