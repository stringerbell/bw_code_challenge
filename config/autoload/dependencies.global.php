<?php

declare(strict_types=1);

use App\Adapters\EmailSender;
use App\Adapters\EmailSenderFactory;
use App\Adapters\EmailSenderInterface;
use App\Middleware\Email\SendEmail;
use App\Middleware\Email\SendEmailFactory;
use App\Models\EmailInterface;
use App\Models\EmailInterfaceFactory;
use App\Pipelines\SendEmailPipeline;
use App\Pipelines\ValidateEmailPipeline;
use App\Services\EmailService;
use App\Services\EmailServiceFactory;
use App\Transformers\Email\RemoveHTMLTags;
use App\Validation\Email\ValidateAllFieldValuesAreStrings;
use App\Validation\Email\ValidateEmailFields;
use App\Validation\Email\ValidateRequiredFields;
use App\Validation\ValidateBody;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases'    => [
            EmailSenderInterface::class => EmailSender::class
            // Fully\Qualified\ClassOrInterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            ValidateBody::class                     => ValidateBody::class,
            ValidateRequiredFields::class           => ValidateRequiredFields::class,
            ValidateAllFieldValuesAreStrings::class => ValidateAllFieldValuesAreStrings::class,
            ValidateEmailFields::class              => ValidateEmailFields::class,
            RemoveHTMLTags::class                   => RemoveHTMLTags::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories'  => [
            SendEmailPipeline::class     => SendEmailPipeline::class,
            ValidateEmailPipeline::class => ValidateEmailPipeline::class,
            SendEmail::class             => SendEmailFactory::class,
            EmailService::class          => EmailServiceFactory::class,
            EmailSender::class           => EmailSenderFactory::class,
            EmailSenderInterface::class  => EmailSender::class,
            EmailInterface::class        => EmailInterfaceFactory::class,
            // Fully\Qualified\ClassName::class => Fully\Qualified\FactoryName::class,
        ],
    ],
];
