<?php

/**
 * form.php
 * Copyright (c) 2019 james@firefly-iii.org
 *
 * This file is part of Firefly III (https://github.com/firefly-iii).
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

return [
    // new user:
    'bank_name'                   => 'Όνομα τράπεζας',
    'bank_balance'                => 'Υπόλοιπο',
    'savings_balance'             => 'Υπόλοιπο αποταμιεύσεων',
    'credit_card_limit'           => 'Όριο πιστωτικής κάρτας',
    'automatch'                   => 'Αυτόματο ταίριασμα',
    'skip'                        => 'Παράλειψη',
    'enabled'                     => 'Ενεργοποιημένο',
    'name'                        => 'Όνομα',
    'active'                      => 'Ενεργό',
    'amount_min'                  => 'Ελάχιστο ποσό',
    'amount_max'                  => 'Μέγιστο ποσό',
    'match'                       => 'Αντιστοιχίες στις',
    'strict'                      => 'Αυστηρή λειτουργία',
    'repeat_freq'                 => 'Επαναλήψεις',
    'object_group'                => 'Ομάδα',
    'location'                    => 'Τοποθεσία',
    'update_channel'              => 'Κανάλι ενημερώσεων',
    'currency_id'                 => 'Νόμισμα',
    'transaction_currency_id'     => 'Νόμισμα',
    'auto_budget_currency_id'     => 'Νόμισμα',
    'external_ip'                 => 'Η εξωτερική IP του εξυπηρετητή σας',
    'attachments'                 => 'Συνημμένα',
    'BIC'                         => 'BIC',
    'verify_password'             => 'Επιβεβαίωση ασφάλειας κωδικού',
    'source_account'              => 'Λογαριασμός προέλευσης',
    'destination_account'         => 'Λογαριασμός προορισμού',
    'asset_destination_account'   => 'Λογαριασμός προορισμού',
    'include_net_worth'           => 'Εντός καθαρής αξίας',
    'asset_source_account'        => 'Λογαριασμός προέλευσης',
    'journal_description'         => 'Περιγραφή',
    'note'                        => 'Σημειώσεις',
    'currency'                    => 'Νόμισμα',
    'account_id'                  => 'Λογαριασμός κεφαλαίου',
    'budget_id'                   => 'Προϋπολογισμός',
    'opening_balance'             => 'Υπόλοιπο έναρξης',
    'tagMode'                     => 'Λειτουργία ετικέτας',
    'virtual_balance'             => 'Εικονικό υπόλοιπο',
    'targetamount'                => 'Ποσό στόχου',
    'account_role'                => 'Ρόλος λογαριασμού',
    'opening_balance_date'        => 'Ημερομηνία υπολοίπου έναρξης',
    'cc_type'                     => 'Σχέδιο πληρωμής πιστωτικής κάρτας',
    'cc_monthly_payment_date'     => 'Ημερομηνία μηνιαίας πληρωμής κάρτας',
    'piggy_bank_id'               => 'Κουμπαράς',
    'returnHere'                  => 'Επιστροφή εδώ',
    'returnHereExplanation'       => 'Μετά την αποθήκευση, επιστρέψτε εδώ για νέα δημιουργία.',
    'returnHereUpdateExplanation' => 'Μετά την ανανέωση, επιστρέψτε εδώ.',
    'description'                 => 'Περιγραφή',
    'expense_account'             => 'Λογαριασμός δαπανών',
    'revenue_account'             => 'Λογαριασμός εσόδων',
    'decimal_places'              => 'Δεκαδικά ψηφία',
    'destination_amount'          => 'Ποσό (προορισμός)',
    'new_email_address'           => 'Νέα διεύθυνση email',
    'verification'                => 'Επαλήθευση',
    'api_key'                     => 'Κλειδί API',
    'remember_me'                 => 'Να με θυμάσαι',
    'liability_type_id'           => 'Τύπος υποχρέωσης',
    'interest'                    => 'Τόκος',
    'interest_period'             => 'Τοκιζόμενη περίοδος',

    'type'               => 'Τύπος',
    'convert_Withdrawal' => 'Μετατροπή ανάληψης',
    'convert_Deposit'    => 'Μετατροπή κατάθεσης',
    'convert_Transfer'   => 'Μετατροπή μεταφοράς',

    'amount'                      => 'Ποσό',
    'foreign_amount'              => 'Ποσό σε ξένο νόμισμα',
    'date'                        => 'Ημερομηνία',
    'interest_date'               => 'Ημερομηνία τοκισμού',
    'book_date'                   => 'Ημερομηνία εγγραφής',
    'process_date'                => 'Ημερομηνία επεξεργασίας',
    'category'                    => 'Κατηγορία',
    'tags'                        => 'Ετικέτες',
    'deletePermanently'           => 'Οριστική διαγραφή',
    'cancel'                      => 'Άκυρο',
    'targetdate'                  => 'Ημερομηνία στόχου',
    'startdate'                   => 'Ημερομηνία Έναρξης',
    'tag'                         => 'Ετικέτα',
    'under'                       => 'Κάτω από',
    'symbol'                      => 'Σύμβολο',
    'code'                        => 'Κωδικός',
    'iban'                        => 'IBAN',
    'account_number'              => 'Αριθμός λογαριασμού',
    'creditCardNumber'            => 'Αριθμός πιστωτικής κάρτας',
    'has_headers'                 => 'Επικεφαλίδες',
    'date_format'                 => 'Μορφή ημερομηνίας',
    'specifix'                    => 'Συγκεκριμένες διορθώσεις τράπεζας-ή αρχείου',
    'attachments[]'               => 'Συνημμένα',
    'title'                       => 'Τίτλος',
    'notes'                       => 'Σημειώσεις',
    'filename'                    => 'Όνομα αρχείου',
    'mime'                        => 'Τύπος Mime',
    'size'                        => 'Μέγεθος',
    'trigger'                     => 'Ενεργοποίηση',
    'stop_processing'             => 'Διακοπή επεξεργασίας',
    'start_date'                  => 'Αρχή του εύρους',
    'end_date'                    => 'Τέλος του εύρους',
    'start'                       => 'Αρχή του εύρους',
    'end'                         => 'Τέλος του εύρους',
    'delete_account'              => 'Διαγραφή λογαριασμού ":name"',
    'delete_bill'                 => 'Διαγραφή πάγιου έξοδου ":name"',
    'delete_budget'               => 'Διαγραφή προϋπολογισμού ":name"',
    'delete_category'             => 'Διαγραφή κατηγορίας ":name"',
    'delete_currency'             => 'Διαγραφή νομίσματος ":name"',
    'delete_journal'              => 'Διαγραφή συναλλαγής με την περιγραφή ":description"',
    'delete_attachment'           => 'Διαγραφή επισυναπτόμενου ":name"',
    'delete_rule'                 => 'Διαγραφή κανόνα ":title"',
    'delete_rule_group'           => 'Διαγραφή ομάδας κανόνων ":title"',
    'delete_link_type'            => 'Διαγραφή τύπου συνδέσμου ":name"',
    'delete_user'                 => 'Διαγραφή χρήστη ":email"',
    'delete_recurring'            => 'Διαγραφή επαναλαμβανόμενης συναλλαγής ":title"',
    'user_areYouSure'             => 'Εάν διαγράψετε το χρήστη ":email", θα χαθούν όλα. Δεν υπάρχει αναίρεση, επαναφορά ή κάτι άλλο. Εάν διαγράψετε τον εαυτό σας, θα χάσετε την πρόσβαση στο Firefly III.',
    'attachment_areYouSure'       => 'Είστε σίγουροι ότι θέλετε να διαγράψετε το συνημμένο με όνομα ":name";',
    'account_areYouSure'          => 'Είστε σίγουροι ότι θέλετε να διαγράψετε το λογαριασμό με όνομα ":name";',
    'bill_areYouSure'             => 'Είστε σίγουροι ότι θέλετε να διαγράψετε το πάγιο έξοδο με όνομα ":name";',
    'rule_areYouSure'             => 'Είστε σίγουροι ότι θέλετε να διαγράψετε τον κανόνα με τίτλο ":title";',
    'object_group_areYouSure'     => 'Είστε σίγουροι ότι θέλετε να διαγράψετε την ομάδα με τίτλο ":title";',
    'ruleGroup_areYouSure'        => 'Είστε σίγουροι ότι θέλετε να διαγράψετε την ομάδα κανόνων με τίτλο ":title";',
    'budget_areYouSure'           => 'Είστε σίγουροι ότι θέλετε να διαγράψετε τον προϋπολογισμό με όνομα ":name";',
    'category_areYouSure'         => 'Είστε σίγουροι ότι θέλετε να διαγράψετε την κατηγορία με όνομα ":name";',
    'recurring_areYouSure'        => 'Είστε σίγουροι ότι θέλετε να διαγράψετε την επαναλαμβανόμενη συναλλαγή με τίτλο ":title";',
    'currency_areYouSure'         => 'Είστε σίγουροι ότι θέλετε να διαγράψετε το νόμισμα με όνομα ":name";',
    'piggyBank_areYouSure'        => 'Είστε σίγουροι ότι θέλετε να διαγράψετε τον κουμπαρά με όνομα ":name";',
    'journal_areYouSure'          => 'Είστε σίγουροι ότι θέλετε να διαγράψετε τη συναλλαγή με περιγραφή ":description";',
    'mass_journal_are_you_sure'   => 'Είστε σίγουροι ότι θέλετε να διαγράψετε αυτές τις συναλλαγές;',
    'tag_areYouSure'              => 'Είστε σίγουροι ότι θέλετε να διαγράψετε την ετικέτα ":tag";',
    'journal_link_areYouSure'     => 'Είστε σίγουροι ότι θέλετε να διαγράψετε το σύνδεσμο μεταξύ <a href=":source_link">:source</a> και <a href=":destination_link">:destination</a>;',
    'linkType_areYouSure'         => 'Είστε σίγουροι ότι θέλετε να διαγράψετε τον τύπο συνδέσμου ":name" (":inward" / ":outward");',
    'permDeleteWarning'           => 'Η διαγραφή στοιχείων από το Firefly III είναι μόνιμη και δεν μπορεί να αναιρεθεί.',
    'mass_make_selection'         => 'Μπορείτε ακόμη να αποτρέψετε τη διαγραφή αντικειμένων αφαιρώντας αυτό το πλαίσιο ελέγχου.',
    'delete_all_permanently'      => 'Μόνιμη διαγραφή επιλεγμένων',
    'update_all_journals'         => 'Ανανέωση αυτών των συναλλαγών',
    'also_delete_transactions'    => 'Η μόνη συναλλαγή που συνδέεται με αυτό το λογαριασμό θα διαγραφεί επίσης.| Και οι :count συναλλαγές που συνδέονται με αυτό το λογαριασμό θα διαγραφούν επίσης.',
    'also_delete_connections'     => 'Η μόνη συνδεδεμένη συναλλαγή με αυτό τον τύπο σύνδεσης θα αποσυνδεθεί.|Όλες οι :count συνδεδεμένες συναλλαγές με αυτό τον τύπο σύνδεσης θα αποσυνδεθούν.',
    'also_delete_rules'           => 'Η μόνη συναλλαγή που συνδέεται με αυτό το λογαριασμό θα διαγραφεί επίσης.| Όλες οι :count συναλλαγές που συνδέονται με αυτό το λογαριασμό θα διαγραφούν επίσης.',
    'also_delete_piggyBanks'      => 'Ο μόνος συνδεδεμένος κουμπαράς σε αυτό τον λογαριασμό θα διαγραφή επίσης.|Όλες οι :count συνδεδεμένοι κουμπαράδες με αυτό τον λογαριασμό θα διαγραφούν επίσης.',
    'not_delete_piggy_banks'      => 'Ο κουμπαράς που είναι συνδεδεμένος σε αυτή την ομάδα δε θα διαγραφεί.| Οι :count κουμπαράδες που είναι συνδεδεμένοι σε αυτή την ομάδα δε θα διαγραφούν.',
    'bill_keep_transactions'      => 'Η μόνη συνδεδεμένη συναλλαγή με αυτό το λογαριασμό δε θα διαγραφεί.|\'Ολες οι :count συνδεδεμένες συναλλαγές με αυτό τον λογαριασμό θα γλυτώσουν από τη διαγραφή.',
    'budget_keep_transactions'    => 'Η μόνη συνδεδεμένη συναλλαγή με αυτό τον προϋπολογισμό δε θα διαγραφεί.|Όλες οι :count συνδεδεμένες συναλλαγές με αυτό τον προϋπολογισμό θα γλυτώσουν από τη διαγραφή.',
    'category_keep_transactions'  => 'Η μόνη συνδεδεμένη συναλλαγή με αυτή την κατηγορία δε θα διαγραφεί.|Όλες οι :count συνδεδεμένες συναλλαγές με αυτή την κατηγορία θα γλυτώσουν από τη διαγραφή.',
    'recurring_keep_transactions' => 'Η μόνη συναλλαγή που δημιουργήθηκε από αυτή την επαναλαμβανόμενη συναλλαγή δε θα διαγραφεί.| \'Ολες οι :count συναλλαγές που δημιουργήθηκαν από αυτή την επαναλαμβανόμενη συναλλαγή θα γλυτώσουν από τη διαγραφή.',
    'tag_keep_transactions'       => 'Η μόνη συνδεδεμένη συναλλαγή με αυτή την ετικέτα δε θα διαγραφεί.|Όλες οι :count συνδεδεμένες συναλλαγές με αυτή την ετικέτα θα γλυτώσουν από τη διαγραφή.',
    'check_for_updates'           => 'Έλεγχος ενημερώσεων',

    'delete_object_group' => 'Διαγραφή ομάδας ":title"',

    'email'                 => 'Διεύθυνση E-mail',
    'password'              => 'Συνθηματικό',
    'password_confirmation' => 'Συνθηματικό (επανάληψη)',
    'blocked'               => 'Έχει αποκλειστεί;',
    'blocked_code'          => 'Αιτία αποκλεισμού',
    'login_name'            => 'Είσοδος',
    'is_owner'              => 'Είναι διαχειριστής;',

    // import
    'apply_rules'           => 'Εφαρμογή κανόνων',
    'artist'                => 'Καλλιτέχνης',
    'album'                 => 'Άλμπουμ',
    'song'                  => 'Τραγούδι',


    // admin
    'domain'                => 'Τομέας (Domain)',
    'single_user_mode'      => 'Απενεργοποίηση εγγραφής χρήστη',
    'is_demo_site'          => 'Είναι ιστότοπος επίδειξης',

    // import
    'configuration_file'    => 'Αρχείο παραμετροποίησης',
    'csv_comma'             => 'Ένα κόμμα (,)',
    'csv_semicolon'         => 'Ένα ερωτηματικό (;)',
    'csv_tab'               => 'Ένα κενό (tab - αόρατο)',
    'csv_delimiter'         => 'Διαχωριστικό πεδίου CSV',
    'client_id'             => 'Αναγνωριστικό πελάτη',
    'app_id'                => 'Αναγνωριστικό εφαρμογής',
    'secret'                => 'Μυστικό',
    'public_key'            => 'Δημόσιο κλειδί',
    'country_code'          => 'Κώδικας χώρας',
    'provider_code'         => 'Τράπεζα ή πάροχος-δεδομένων',
    'fints_url'             => 'Διεύθυνση URL FinTS API',
    'fints_port'            => 'Πόρτα',
    'fints_bank_code'       => 'Κωδικός τράπεζας',
    'fints_username'        => 'Όνομα χρήστη',
    'fints_password'        => 'PIN / Κωδικός',
    'fints_account'         => 'Λογαριασμός FinTS',
    'local_account'         => 'Λογαριασμός Firefly III',
    'from_date'             => 'Από ημερομηνία',
    'to_date'               => 'Εώς ημερομηνία',


    'due_date'                => 'Ημερομηνία προθεσμίας',
    'payment_date'            => 'Ημερομηνία πληρωμής',
    'invoice_date'            => 'Ημερομηνία τιμολόγησης',
    'internal_reference'      => 'Εσωτερική αναφορά',
    'inward'                  => 'Εσωτερική περιγραφή',
    'outward'                 => 'Εξωτερική περιγραφή',
    'rule_group_id'           => 'Ομάδα κανόνων',
    'transaction_description' => 'Περιγραφή συναλλαγής',
    'first_date'              => 'Πρώτη ημερομηνία',
    'transaction_type'        => 'Τύπος συναλλαγής',
    'repeat_until'            => 'Επανάληψη εώς',
    'recurring_description'   => 'Περιγραφή επαναλαμβανόμενης συναλλαγής',
    'repetition_type'         => 'Τύπος επανάληψης',
    'foreign_currency_id'     => 'Ξένο νόμισμα',
    'repetition_end'          => 'Τέλος επανάληψης',
    'repetitions'             => 'Επαναλήψεις',
    'calendar'                => 'Ημερολόγιο',
    'weekend'                 => 'Σαββατοκύριακο',
    'client_secret'           => 'Μυστικό πελάτη',

    'withdrawal_destination_id' => 'Λογαριασμός προορισμού',
    'deposit_source_id'         => 'Λογαριασμός προέλευσης',
    'expected_on'               => 'Αναμένεται στις',
    'paid'                      => 'Πληρώθηκε',

    'auto_budget_type'   => 'Αυτόματος προϋπολογισμός',
    'auto_budget_amount' => 'Ποσό αυτόματου προϋπολογισμού',
    'auto_budget_period' => 'Περίοδος αυτόματου προϋπολογισμού',

    'collected' => 'Συλλέχθηκε',
    'submitted' => 'Υποβλήθηκε',
    'key'       => 'Κλειδί',
    'value'     => 'Περιεχόμενο της εγγραφής',


];
