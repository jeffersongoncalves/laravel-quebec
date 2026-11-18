<?php

namespace JeffersonGoncalves\Quebec\Attributes;

use Attribute;
use JeffersonGoncalves\Privacy\Attributes\PersonalDataAttribute;
use JeffersonGoncalves\Quebec\Enums\AnonymizeStrategy;
use JeffersonGoncalves\Quebec\Enums\DataCategory;

/**
 * Declares one column of an Eloquent model as personal information under Quebec's private sector
 * privacy act (Law 25). outsideQuebec flags information communicated outside Quebec (a privacy
 * impact assessment first, s. 17); profiling flags information collected with technology that
 * identifies, locates or profiles the person (s. 8.1).
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class PersonalData extends PersonalDataAttribute
{
    public function __construct(
        public string $column,
        public DataCategory $category = DataCategory::Personal,
        public ?string $purpose = null,
        public ?string $retention = null,
        AnonymizeStrategy $anonymize = AnonymizeStrategy::Nullify,
        public bool $outsideQuebec = false,
        public bool $profiling = false,
    ) {
        $this->anonymize = $anonymize;
    }

    /**
     * @return array{column: string, category: string, purpose: string|null, retention: string|null, anonymize: string, outside_quebec: bool, profiling: bool}
     */
    public function toArray(): array
    {
        return [
            'column' => $this->column,
            'category' => $this->category->value,
            'purpose' => $this->purpose,
            'retention' => $this->retention,
            'anonymize' => $this->anonymize->value,
            'outside_quebec' => $this->outsideQuebec,
            'profiling' => $this->profiling,
        ];
    }
}
