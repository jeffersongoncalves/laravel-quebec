<?php

namespace JeffersonGoncalves\Quebec\Enums;

enum DataCategory: string
{
    /** Personal information: any information concerning a natural person that allows them to be identified (s. 2). */
    case Personal = 'personal';

    /**
     * Sensitive personal information (s. 12): due to its medical, biometric or otherwise intimate
     * nature, or the context of its use or communication, it entails a high level of reasonable
     * expectation of privacy. Its use for another purpose needs express consent.
     */
    case Sensitive = 'sensitive';
}
