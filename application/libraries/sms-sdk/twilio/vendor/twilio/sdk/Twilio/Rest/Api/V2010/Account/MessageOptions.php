<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Options;
use Twilio\Values;

abstract class MessageOptions {
    /**
     * @param string $from The phone number that initiated the message
     * @param string $messagingServiceSid The 34 character unique id of the
     *                                    Messaging Service you want to associate
     *                                    with this Message.
     * @param string $body The text of the message you want to send, limited to
     *                     1600 characters.
     * @param string $mediaUrl The URL of the media you wish to send out with the
     *                         message.
     * @param string $statusCallback URL Twilio will request when the status changes
     * @param string $applicationSid The application to use for callbacks
     * @param string $maxPrice The total maximum price up to the fourth decimal in
     *                         US dollars acceptable for the message to be
     *                         delivered.
     * @param boolean $provideFeedback Set this value to true if you are sending
     *                                 messages that have a trackable user action
     *                                 and you intend to confirm delivery of the
     *                                 message using the Message Feedback API.
     * @param integer $validityPeriod The number of seconds that the message can
     *                                remain in a Twilio queue.
     * @param string $maxRate The max_rate
     * @param boolean $forceDelivery The force_delivery
     * @param string $providerSid The provider_sid
     * @param string $contentRetention The content_retention
     * @param string $addressRetention The address_retention
     * @param boolean $smartEncoded The smart_encoded
     * @return CreateMessageOptions Options builder
     */
    public static function create($from = Values::NONE, $messagingServiceSid = Values::NONE, $body = Values::NONE, $mediaUrl = Values::NONE, $statusCallback = Values::NONE, $applicationSid = Values::NONE, $maxPrice = Values::NONE, $provideFeedback = Values::NONE, $validityPeriod = Values::NONE, $maxRate = Values::NONE, $forceDelivery = Values::NONE, $providerSid = Values::NONE, $contentRetention = Values::NONE, $addressRetention = Values::NONE, $smartEncoded = Values::NONE) {
        return new CreateMessageOptions($from, $messagingServiceSid, $body, $mediaUrl, $statusCallback, $applicationSid, $maxPrice, $provideFeedback, $validityPeriod, $maxRate, $forceDelivery, $providerSid, $contentRetention, $addressRetention, $smartEncoded);
    }

    /**
     * @param string $to Filter by messages to this number
     * @param string $from Filter by from number
     * @param string $dateSentBefore Filter by date sent
     * @param string $dateSent Filter by date sent
     * @param string $dateSentAfter Filter by date sent
     * @return ReadMessageOptions Options builder
     */
    public static function read($to = Values::NONE, $from = Values::NONE, $dateSentBefore = Values::NONE, $dateSent = Values::NONE, $dateSentAfter = Values::NONE) {
        return new ReadMessageOptions($to, $from, $dateSentBefore, $dateSent, $dateSentAfter);
    }
}

class CreateMessageOptions extends Options {
    /**
     * @param string $from The phone number that initiated the message
     * @param string $messagingServiceSid The 34 character unique id of the
     *                                    Messaging Service you want to associate
     *                                    with this Message.
     * @param string $body The text of the message you want to send, limited to
     *                     1600 characters.
     * @param string $mediaUrl The URL of the media you wish to send out with the
     *                         message.
     * @param string $statusCallback URL Twilio will request when the status changes
     * @param string $applicationSid The application to use for callbacks
     * @param string $maxPrice The total maximum price up to the fourth decimal in
     *                         US dollars acceptable for the message to be
     *                         delivered.
     * @param boolean $provideFeedback Set this value to true if you are sending
     *                                 messages that have a trackable user action
     *                                 and you intend to confirm delivery of the
     *                                 message using the Message Feedback API.
     * @param integer $validityPeriod The number of seconds that the message can
     *                                remain in a Twilio queue.
     * @param string $maxRate The max_rate
     * @param boolean $forceDelivery The force_delivery
     * @param string $providerSid The provider_sid
     * @param string $contentRetention The content_retention
     * @param string $addressRetention The address_retention
     * @param boolean $smartEncoded The smart_encoded
     */
    public function __construct($from = Values::NONE, $messagingServiceSid = Values::NONE, $body = Values::NONE, $mediaUrl = Values::NONE, $statusCallback = Values::NONE, $applicationSid = Values::NONE, $maxPrice = Values::NONE, $provideFeedback = Values::NONE, $validityPeriod = Values::NONE, $maxRate = Values::NONE, $forceDelivery = Values::NONE, $providerSid = Values::NONE, $contentRetention = Values::NONE, $addressRetention = Values::NONE, $smartEncoded = Values::NONE) {
        $this->options['from'] = $from;
        $this->options['messagingServiceSid'] = $messagingServiceSid;
        $this->options['body'] = $body;
        $this->options['mediaUrl'] = $mediaUrl;
        $this->options['statusCallback'] = $statusCallback;
        $this->options['applicationSid'] = $applicationSid;
        $this->options['maxPrice'] = $maxPrice;
        $this->options['provideFeedback'] = $provideFeedback;
        $this->options['validityPeriod'] = $validityPeriod;
        $this->options['maxRate'] = $maxRate;
        $this->options['forceDelivery'] = $forceDelivery;
        $this->options['providerSid'] = $providerSid;
        $this->options['contentRetention'] = $contentRetention;
        $this->options['addressRetention'] = $addressRetention;
        $this->options['smartEncoded'] = $smartEncoded;
    }

    /**
     * A Twilio phone number (in [E.164](https://www.twilio.com/docs/glossary/what-e164) format),  [alphanumeric sender ID](https://www.twilio.com/docs/api/messaging/send-messages#alpha-sender-id) or a [Channel Endpoint address](https://www.twilio.com/docs/api/channels#channel-addresses) enabled for the type of message you wish to send. Phone numbers or [short codes](https://www.twilio.com/docs/sms/api/short-codes) purchased from Twilio work here. You cannot (for example) spoof messages from your own cell phone number. *Should not be passed if you are using MessagingServiceSid.*
     * 
     * @param string $from The phone number that initiated the message
     * @return $this Fluent Builder
     */
    public function setFrom($from) {
        $this->options['from'] = $from;
        return $this;
    }

    /**
     * The 34 character unique id of the [Messaging Service](https://www.twilio.com/docs/api/messaging/send-messages#messaging-services) you want to associate with this Message. Set this parameter to use the Messaging Service Settings and [Copilot Features](https://www.twilio.com/docs/api/messaging/send-messages-copilot) you have configured. When only this parameter is set, Twilio will use your enabled Copilot Features to select the From phone number for delivery. *Should not be passed if you are using From.*
     * 
     * @param string $messagingServiceSid The 34 character unique id of the
     *                                    Messaging Service you want to associate
     *                                    with this Message.
     * @return $this Fluent Builder
     */
    public function setMessagingServiceSid($messagingServiceSid) {
        $this->options['messagingServiceSid'] = $messagingServiceSid;
        return $this;
    }

    /**
     * The text of the message you want to send, limited to 1600 characters.
     * 
     * @param string $body The text of the message you want to send, limited to
     *                     1600 characters.
     * @return $this Fluent Builder
     */
    public function setBody($body) {
        $this->options['body'] = $body;
        return $this;
    }

    /**
     * The URL of the media you wish to send out with the message. `gif` , `png` and `jpeg` content is currently supported and will be formatted correctly on the recipient's device. [Other types](https://www.twilio.com/docs/api/messaging/accepted-mime-types) are also accepted by the API. The media size limit is 5MB. If you wish to send more than one image in the message body, please provide multiple MediaUrls values in the POST request. You may include up to 10 MediaUrls per message.
     * 
     * @param string $mediaUrl The URL of the media you wish to send out with the
     *                         message.
     * @return $this Fluent Builder
     */
    public function setMediaUrl($mediaUrl) {
        $this->options['mediaUrl'] = $mediaUrl;
        return $this;
    }

    /**
     * A URL where Twilio will POST each time your message status changes to one of the following: `queued`, `failed`, `sent`, `delivered`, or `undelivered`. Twilio will POST the `MessageSid` along with the other [standard request parameters](https://www.twilio.com/docs/api/twiml/sms/twilio_request#request-parameters) as well as `MessageStatus` and `ErrorCode`. If this parameter passed in addition to a `MessagingServiceSid`, Twilio will override the Status Callback URL of the [Messaging Service](https://www.twilio.com/docs/api/messaging/send-messages#messaging-services). URLs must contain a valid hostname (underscores are not allowed).
     * 
     * @param string $statusCallback URL Twilio will request when the status changes
     * @return $this Fluent Builder
     */
    public function setStatusCallback($statusCallback) {
        $this->options['statusCallback'] = $statusCallback;
        return $this;
    }

    /**
     * Twilio will POST `MessageSid` as well as `MessageStatus=sent` or `MessageStatus=failed` to the URL in the `MessageStatusCallback` property of this [Application](https://www.twilio.com/docs/api/rest/applications). If the `StatusCallback` parameter above is also passed, the Application's `MessageStatusCallback` parameter will take precedence.
     * 
     * @param string $applicationSid The application to use for callbacks
     * @return $this Fluent Builder
     */
    public function setApplicationSid($applicationSid) {
        $this->options['applicationSid'] = $applicationSid;
        return $this;
    }

    /**
     * The total maximum price up to the fourth decimal (0.0001) in US dollars acceptable for the message to be delivered. All messages regardless of the price point will be queued for delivery. A POST request will later be made to your Status Callback URL with a status change of 'Sent' or 'Failed'. When the price of the message is above this value the message will fail and not be sent. When MaxPrice is not set, all prices for the message is accepted.
     * 
     * @param string $maxPrice The total maximum price up to the fourth decimal in
     *                         US dollars acceptable for the message to be
     *                         delivered.
     * @return $this Fluent Builder
     */
    public function setMaxPrice($maxPrice) {
        $this->options['maxPrice'] = $maxPrice;
        return $this;
    }

    /**
     * Set this value to `true` if you are sending messages that have a trackable user action and you intend to confirm delivery of the message using the [Message Feedback API](https://www.twilio.com/docs/api/messaging/message-feedback). This parameter is set to `false` by default.
     * 
     * @param boolean $provideFeedback Set this value to true if you are sending
     *                                 messages that have a trackable user action
     *                                 and you intend to confirm delivery of the
     *                                 message using the Message Feedback API.
     * @return $this Fluent Builder
     */
    public function setProvideFeedback($provideFeedback) {
        $this->options['provideFeedback'] = $provideFeedback;
        return $this;
    }

    /**
     * The number of seconds that the message can remain in a Twilio queue. After exceeding this time limit, the message will fail and a POST request will later be made to your Status Callback URL. Valid values are between 1 and 14400 seconds (the default). Please note that Twilio cannot guarantee that a message will not be queued by the carrier after they accept the message. We do not recommend setting validity periods of less than 5 seconds.
     * 
     * @param integer $validityPeriod The number of seconds that the message can
     *                                remain in a Twilio queue.
     * @return $this Fluent Builder
     */
    public function setValidityPeriod($validityPeriod) {
        $this->options['validityPeriod'] = $validityPeriod;
        return $this;
    }

    /**
     * The max_rate
     * 
     * @param string $maxRate The max_rate
     * @return $this Fluent Builder
     */
    public function setMaxRate($maxRate) {
        $this->options['maxRate'] = $maxRate;
        return $this;
    }

    /**
     * The force_delivery
     * 
     * @param boolean $forceDelivery The force_delivery
     * @return $this Fluent Builder
     */
    public function setForceDelivery($forceDelivery) {
        $this->options['forceDelivery'] = $forceDelivery;
        return $this;
    }

    /**
     * The provider_sid
     * 
     * @param string $providerSid The provider_sid
     * @return $this Fluent Builder
     */
    public function setProviderSid($providerSid) {
        $this->options['providerSid'] = $providerSid;
        return $this;
    }

    /**
     * The content_retention
     * 
     * @param string $contentRetention The content_retention
     * @return $this Fluent Builder
     */
    public function setContentRetention($contentRetention) {
        $this->options['contentRetention'] = $contentRetention;
        return $this;
    }

    /**
     * The address_retention
     * 
     * @param string $addressRetention The address_retention
     * @return $this Fluent Builder
     */
    public function setAddressRetention($addressRetention) {
        $this->options['addressRetention'] = $addressRetention;
        return $this;
    }

    /**
     * The smart_encoded
     * 
     * @param boolean $smartEncoded The smart_encoded
     * @return $this Fluent Builder
     */
    public function setSmartEncoded($smartEncoded) {
        $this->options['smartEncoded'] = $smartEncoded;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Api.V2010.CreateMessageOptions ' . implode(' ', $options) . ']';
    }
}

class ReadMessageOptions extends Options {
    /**
     * @param string $to Filter by messages to this number
     * @param string $from Filter by from number
     * @param string $dateSentBefore Filter by date sent
     * @param string $dateSent Filter by date sent
     * @param string $dateSentAfter Filter by date sent
     */
    public function __construct($to = Values::NONE, $from = Values::NONE, $dateSentBefore = Values::NONE, $dateSent = Values::NONE, $dateSentAfter = Values::NONE) {
        $this->options['to'] = $to;
        $this->options['from'] = $from;
        $this->options['dateSentBefore'] = $dateSentBefore;
        $this->options['dateSent'] = $dateSent;
        $this->options['dateSentAfter'] = $dateSentAfter;
    }

    /**
     * Only show messages to this phone number.
     * 
     * @param string $to Filter by messages to this number
     * @return $this Fluent Builder
     */
    public function setTo($to) {
        $this->options['to'] = $to;
        return $this;
    }

    /**
     * Only show messages from this phone number or alphanumeric sender ID.
     * 
     * @param string $from Filter by from number
     * @return $this Fluent Builder
     */
    public function setFrom($from) {
        $this->options['from'] = $from;
        return $this;
    }

    /**
     * Only show messages sent on this date (in [GMT](https://en.wikipedia.org/wiki/Greenwich_Mean_Time) format), given as `YYYY-MM-DD`. Example: `DateSent=2009-07-06`. You can also specify inequality, such as `DateSent<=YYYY-MM-DD` for messages that were sent on or before midnight on a date, and `DateSent>=YYYY-MM-DD` for messages sent on or after midnight on a date.
     * 
     * @param string $dateSentBefore Filter by date sent
     * @return $this Fluent Builder
     */
    public function setDateSentBefore($dateSentBefore) {
        $this->options['dateSentBefore'] = $dateSentBefore;
        return $this;
    }

    /**
     * Only show messages sent on this date (in [GMT](https://en.wikipedia.org/wiki/Greenwich_Mean_Time) format), given as `YYYY-MM-DD`. Example: `DateSent=2009-07-06`. You can also specify inequality, such as `DateSent<=YYYY-MM-DD` for messages that were sent on or before midnight on a date, and `DateSent>=YYYY-MM-DD` for messages sent on or after midnight on a date.
     * 
     * @param string $dateSent Filter by date sent
     * @return $this Fluent Builder
     */
    public function setDateSent($dateSent) {
        $this->options['dateSent'] = $dateSent;
        return $this;
    }

    /**
     * Only show messages sent on this date (in [GMT](https://en.wikipedia.org/wiki/Greenwich_Mean_Time) format), given as `YYYY-MM-DD`. Example: `DateSent=2009-07-06`. You can also specify inequality, such as `DateSent<=YYYY-MM-DD` for messages that were sent on or before midnight on a date, and `DateSent>=YYYY-MM-DD` for messages sent on or after midnight on a date.
     * 
     * @param string $dateSentAfter Filter by date sent
     * @return $this Fluent Builder
     */
    public function setDateSentAfter($dateSentAfter) {
        $this->options['dateSentAfter'] = $dateSentAfter;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Api.V2010.ReadMessageOptions ' . implode(' ', $options) . ']';
    }
}