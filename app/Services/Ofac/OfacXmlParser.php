<?php

namespace App\Services\Ofac;

use SimpleXMLElement;

class OfacXmlParser
{
    public function parse(string $xml, string $listType = 'sdn'): array
    {
        $sx = new SimpleXMLElement($xml);

        // Get namespaces
        $ns = $sx->getNamespaces(true);
        $defaultNs = $ns[''] ?? null;

        // Fetch all SanctionsEntry nodes
        if ($defaultNs) {
            $sx->registerXPathNamespace('ns', $defaultNs);
            $nodes = $sx->xpath('//ns:SanctionsEntry') ?: [];
        } else {
            $nodes = $sx->xpath('//SanctionsEntry') ?: [];
        }

        $entries = [];
        foreach ($nodes as $node) {
            $entry = $this->parseEntry($node, $defaultNs, $listType);
            if ($entry !== null) {
                $entries[] = $entry;
            }
        }

        return $entries;
    }

    private function parseEntry(SimpleXMLElement $node, ?string $ns = null, string $listType = 'sdn'): ?array
    {
        $uid = (string) ($node['ID'] ?? $node['ProfileID'] ?? '');
        if (!$uid) return null;

        // Name / Entity type
        $name = '[NO NAME]';
        $entityType = 'unknown';
        $party = $node->Party ?? null;
        $entity = $node->Entity ?? null;

        if ($party) {
            $first = (string) ($party->FirstName ?? '');
            $last  = (string) ($party->LastName ?? '');
            $nameNode = (string) ($party->Name ?? '');
            $name = trim($nameNode ?: trim("$first $last"));
            $entityType = (string) ($party->PartyType ?? 'individual');
        } elseif ($entity) {
            $name = (string) ($entity->Name ?? '[NO NAME]');
            $entityType = (string) ($entity->EntityType ?? 'entity');
        } else {
            foreach ($node->SanctionsMeasure as $sm) {
                $comment = trim((string)$sm->Comment);
                if ($comment !== '') {
                    $name = $comment;
                    $entityType = 'entity';
                    break;
                }
            }
        }

        // Source date
        $sourceDate = null;
        if (isset($node->EntryEvent->Date)) {
            $year  = (string) ($node->EntryEvent->Date->Year ?? '');
            $month = str_pad((string) ($node->EntryEvent->Date->Month ?? '01'), 2, '0', STR_PAD_LEFT);
            $day   = str_pad((string) ($node->EntryEvent->Date->Day ?? '01'), 2, '0', STR_PAD_LEFT);
            if ($year) $sourceDate = "$year-$month-$day";
        }

        // Programs
        $programs = [];
        $programSummary = [];
        if (isset($node->SanctionsMeasure)) {
            foreach ($node->SanctionsMeasure as $sm) {
                $programCode = trim((string) $sm->SanctionsTypeID);
                $comment = trim((string) $sm->Comment);

                if ($programCode !== '') {
                    $programs[] = ['program_code' => $programCode];
                } elseif ($comment !== '') {
                    $programs[] = ['program_code' => $comment];
                }

                if ($comment !== '') $programSummary[] = $comment;
            }
        }

        // AKAs
        $akas = [];
        if (isset($node->AKA)) {
            foreach ($node->AKA as $aka) {
                $alias = trim((string)$aka->Name ?? '');
                if ($alias !== '') $akas[] = ['alias' => $alias, 'strength' => null];
            }
        }

        // Addresses
        $addresses = [];
        if (isset($node->Address)) {
            foreach ($node->Address as $addr) {
                $addresses[] = [
                    'address' => (string) ($addr->Street1 ?? ''),
                    'city'    => (string) ($addr->City ?? ''),
                    'state'   => (string) ($addr->StateOrProvince ?? ''),
                    'postal'  => (string) ($addr->PostalCode ?? ''),
                    'country' => (string) ($addr->Country ?? ''),
                ];
            }
        }

        // IDs
        $ids = [];
        if (isset($node->IDList)) {
            foreach ($node->IDList->ID as $id) {
                $ids[] = [
                    'type'    => (string) ($id->IDType ?? ''),
                    'number'  => (string) ($id->IDNumber ?? ''),
                    'country' => (string) ($id->Country ?? ''),
                ];
            }
        }

        // Citizenships
        $citizenships = [];
        if (isset($node->Citizenship)) {
            foreach ($node->Citizenship as $c) {
                $citizenships[] = ['country' => (string) ($c->Country ?? '')];
            }
        }

        return [
            'uid'             => $uid,
            'name'            => $name,
            'entity_type'     => $entityType,
            'remarks'         => '',
            'source_date'     => $sourceDate,
            'programs'        => $programs,
            'program_summary' => implode(', ', $programSummary),
            'akas'            => $akas,
            'addresses'       => $addresses,
            'ids'             => $ids,
            'citizenships'    => $citizenships,
            'list_type'       => $listType,
            'version_ns'      => $ns,
        ];
    }
}
