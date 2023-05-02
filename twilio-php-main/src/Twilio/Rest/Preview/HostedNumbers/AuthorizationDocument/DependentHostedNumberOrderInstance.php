<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\HostedNumbers\AuthorizationDocument;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $sid
 * @property string $accountSid
 * @property string $incomingPhoneNumberSid
 * @property string $addressSid
 * @property string $signingDocumentSid
 * @property string $phoneNumber
 * @property string $capabilities
 * @property string $friendlyName
 * @property string $uniqueName
 * @property string $status
 * @property string $failureReason
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property int $verificationAttempts
 * @property string $email
 * @property string[] $ccEmails
 * @property string $verificationType
 * @property string $verificationDocumentSid
 * @property string $extension
 * @property int $callDelay
 * @property string $verificationCode
 * @property string[] $verificationCallSids
 */
class DependentHostedNumberOrderInstance extends InstanceResource {
    /**
     * Initialize the DependentHostedNumberOrderInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $signingDocumentSid LOA document sid.
     */
    public function __construct(Version $version, array $payload, string $signingDocumentSid) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'incomingPhoneNumberSid' => Values::array_get($payload, 'incoming_phone_number_sid'),
            'addressSid' => Values::array_get($payload, 'address_sid'),
            'signingDocumentSid' => Values::array_get($payload, 'signing_document_sid'),
            'phoneNumber' => Values::array_get($payload, 'phone_number'),
            'capabilities' => Values::array_get($payload, 'capabilities'),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'uniqueName' => Values::array_get($payload, 'unique_name'),
            'status' => Values::array_get($payload, 'status'),
            'failureReason' => Values::array_get($payload, 'failure_reason'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'verificationAttempts' => Values::array_get($payload, 'verification_attempts'),
            'email' => Values::array_get($payload, 'email'),
            'ccEmails' => Values::array_get($payload, 'cc_emails'),
            'verificationType' => Values::array_get($payload, 'verification_type'),
            'verificationDocumentSid' => Values::array_get($payload, 'verification_document_sid'),
            'extension' => Values::array_get($payload, 'extension'),
            'callDelay' => Values::array_get($payload, 'call_delay'),
            'verificationCode' => Values::array_get($payload, 'verification_code'),
            'verificationCallSids' => Values::array_get($payload, 'verification_call_sids'),
        ];

        $this->solution = ['signingDocumentSid' => $signingDocumentSid, ];
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name) {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Preview.HostedNumbers.DependentHostedNumberOrderInstance]';
    }
}