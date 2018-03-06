<?php

namespace Nuwave\Lighthouse\Schema\Directives\Fields;

use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\FieldResolver;
use Nuwave\Lighthouse\Support\Traits\HandlesDirectives;

class BelongsTo implements FieldResolver
{
    use HandlesDirectives;

    /**
     * Name of the directive.
     *
     * @return string
     */
    public function name()
    {
        return 'belongsTo';
    }

    /**
     * Resolve the field directive.
     *
     * @param FieldValue $value
     *
     * @return \Closure
     */
    public function handle(FieldValue $value)
    {
        $relation = $this->directiveArgValue(
            $this->fieldDirective($value->getField(), 'belongsTo'),
            'relation',
            $value->getField()->name->value
        );

        return $value->setResolver(function ($root, array $args) use ($relation) {
            return $root->{$relation};
        });
    }
}
