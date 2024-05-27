<?php

namespace Database\Seeders;

use App\Models\planing\Project;
use App\Models\planing\ProjectBacklog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Active
        Project::create(['user_id' =>  1, 'order' =>  1, 'project_type_id' =>  1,
            'name' =>  'SMS',
            'size' => 5,
            'fe_points' =>  20,'fe_days' =>  5, 'fe_ot_points' =>  0,
            'be_points' =>  20, 'be_days' =>  5, 'be_ot_points' =>  0,
            'fe_progress_points' =>  20, 'be_progress_points' =>  20,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  2, 'project_type_id' =>  1,
            'name' =>  'Support phonenumber',
            'size' => 5,
            'fe_points' =>  20,'fe_days' =>  5, 'fe_ot_points' =>  0,
            'be_points' =>  20, 'be_days' =>  5, 'be_ot_points' =>  0,
            'fe_progress_points' =>  20, 'be_progress_points' =>  20,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  3, 'project_type_id' =>  1,
            'name' =>  'Re-send newsletter',
            'size' => 5,
            'fe_points' =>  10,'fe_days' =>  2.5, 'fe_ot_points' =>  0,
            'be_points' =>  10, 'be_days' =>  2.5, 'be_ot_points' =>  0,
            'fe_progress_points' =>  5, 'be_progress_points' =>  5,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  4, 'project_type_id' =>  1,
            'name' =>  'Fortnox connect',
            'size' => 5,
            'fe_points' =>  10,'fe_days' =>  2.5, 'fe_ot_points' =>  0,
            'be_points' =>  10, 'be_days' =>  2.5, 'be_ot_points' =>  0,
            'fe_progress_points' =>  5, 'be_progress_points' =>  5,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  5, 'project_type_id' =>  1,
            'name' =>  'Preheader',
            'size' => 5,
            'fe_points' =>  10,'fe_days' =>  2.5, 'fe_ot_points' =>  0,
            'be_points' =>  10, 'be_days' =>  2.5, 'be_ot_points' =>  0,
            'fe_progress_points' =>  2, 'be_progress_points' =>  2,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  6, 'project_type_id' =>  1,
            'name' =>  'DMARC',
            'size' => 5,
            'fe_points' =>  10,'fe_days' =>  2.5, 'fe_ot_points' =>  0,
            'be_points' =>  10, 'be_days' =>  2.5, 'be_ot_points' =>  0,
            'fe_progress_points' =>  2, 'be_progress_points' =>  2,
        ]);

        // Planing
        Project::create(['user_id' =>  1, 'order' =>  7, 'project_type_id' =>  3,
            'name' =>  'Stop all communication for SMS',
            'fe_perc' =>  5,'fe_days' =>  0.5, 'be_ot_perc' =>  0,
            'be_perc' =>  95, 'be_days' =>  9.5, 'fe_ot_perc' =>  0,
            'size' => 10,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  8, 'project_type_id' =>  3,
            'name' =>  'Link shorterner',
            'fe_perc' =>  20,'fe_days' =>  1, 'be_ot_perc' =>  0,
            'be_perc' =>  80, 'be_days' =>  4, 'fe_ot_perc' =>  0,
            'size' => 5,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  9, 'project_type_id' =>  3,
            'name' =>  '– Collect SMS Link shorterner statistics',
            'fe_perc' =>  50,'fe_days' =>  2.5, 'be_ot_perc' =>  0,
            'be_perc' =>  50, 'be_days' =>  2.5, 'fe_ot_perc' =>  0,
            'size' => 5,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  10, 'project_type_id' =>  3,
            'name' =>  '– SMS Link shorterner statistics in report ',
            'fe_perc' =>  50,'fe_days' =>  2.5, 'be_ot_perc' =>  0,
            'be_perc' =>  50, 'be_days' =>  2.5, 'fe_ot_perc' =>  0,
            'size' => 10,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  11, 'project_type_id' =>  3,
            'name' =>  'Statistik för popup-formulär',
            'fe_perc' =>  30,'fe_days' =>  3, 'be_ot_perc' =>  0,
            'be_perc' =>  70, 'be_days' =>  7, 'fe_ot_perc' =>  0,
            'size' => 10,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  12, 'project_type_id' =>  3,
            'name' =>  'Graphic profile for customer',
            'fe_perc' =>  80,'fe_days' =>  16, 'be_ot_perc' =>  0,
            'be_perc' =>  20, 'be_days' =>  4, 'fe_ot_perc' =>  0,
            'size' => 20,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  13, 'project_type_id' =>  3,
            'name' =>  'Lime go connect',
            'fe_perc' =>  90,'fe_days' =>  4.5, 'be_ot_perc' =>  0,
            'be_perc' =>  10, 'be_days' =>  0.5, 'fe_ot_perc' =>  0,
            'size' => 5,
        ]);
        Project::create(['user_id' =>  1, 'order' =>  14, 'project_type_id' =>  3,
            'name' =>  'Omdesigna dashboard i appen',
            'fe_perc' =>  90,'fe_days' =>  4.5, 'be_ot_perc' =>  0,
            'be_perc' =>  10, 'be_days' =>  0.5, 'fe_ot_perc' =>  0,
            'size' => 5,
        ]);


        // Backlog
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'More types for attributes',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Simple poll-block',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Add support for plan-based blocks',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Rate my newsletter-block',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'JS Forms – Standard plan features',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Two-factor auth',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Forms/Pages statistics',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Increase trial conversion',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'List detail view',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Improve subscription handling',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Handle unpaid invoices',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Customer state & statistics',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Add support for tab navigation',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Export report as PDF',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Migrate from E-pay to Stripe',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'User permissions',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Custom tracking domain',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Open & ClickLog',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Store final delivery date for newsletter post',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'api-php',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Wordpress plugin',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Visualize spam complaints',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Send to those who did/didnt do X on newsletter Y (Standard)',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Export report as PDF',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Add share-card to reports',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Add support for plan-based blocks',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Simple poll',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Rate my newsletter',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'JS Forms – Standard plan features',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'SMS sending',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Multiple users ',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Access rights ',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Autoresponder as a package',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Automisation - if X then Y',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Report with revenue data',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Tell Friend on Steroids ',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Newsletter Archive',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Paid newsletters',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Improved upgrade-page that has better support for plan levels',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'JS Forms statistics',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Blockeditor template categories',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Improve async tasks in frontend(Better feedback for customers when they export, copy etc...)',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Connect Surveys with contacts',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'New image manager',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Social signup',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Update JS form flow to make it consistent with Surveys and Landing pages',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Show screenshot of mail as thumbnail instead of a static template image',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Click & Open statistics from data warehouse',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Customer state and statistics',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'States på partners / differentiate',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Prevent multiple users from editing at the same time',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Kunna se på vilket sätt kunden har kommit in på listan / Källa på kontakten',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Zapier',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Wordpress pluginet (Uppdatera, nytt eller avveckla?)',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'How to prevent abuse in content (Spamassasin?) ',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Affärsregler kring betalningar och prenumerationer',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'GDPR - juridiskt och technical compliant contact handling ',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Gamla editorn',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Bildhanteraren',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  '2FA',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  4, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Säkerhet för appen (Pentest)',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  1, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Media manager',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  1, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Tiny MCE',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  1, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'MariaDB 10.11 migration',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  3, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Typescript',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  3, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Playwright (Integrationstester)',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  3, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Django 5.0',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  3, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Upgrade dependencies',
        ]);
        ProjectBacklog::create(['user_id' =>  1, 'project_type_id' =>  3, 'prio' =>  5, 'quarter' =>  0, 'size' =>  5, 'be_perc' =>  50, 'fe_perc' =>  50,
            'name' =>  'Rewrite schedule of mail to use celery',
        ]);
    }
}
