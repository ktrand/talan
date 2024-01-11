<?php

namespace App\Controllers;

use App\Models\Bitrix24Api;
use App\Models\Contact;
use App\Models\Deal;

class DealsController
{
    public function getDealsList() {
        $bitrixApi = new Bitrix24Api();
        $deals = $bitrixApi->getDealsList();

        if (is_array($deals['result'])) {
            foreach ($deals['result'] as $deal) {
                $contactId = $deal['CONTACT_ID'];
                $contactFields = $bitrixApi->getContact($contactId);
                $contact = new Contact($contactFields['result']);
                $contactId = $contact->save();
                $deal = new Deal($deal['ID'], $deal['TITLE'], $deal['TYPE_ID'], $contactId, $deal['CLOSEDATE']);
                $deal->save();
            }
        }

        return Deal::getListWithContacts();
    }
}