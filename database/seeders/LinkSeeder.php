<?php

namespace Database\Seeders;

use App\Models\link\Cat;
use App\Models\link\Link;
use App\Models\link\SpeedButton;
use App\Models\link\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Cat::create(['user_id'=> 1, 'name'=>'GAN']);        //1
        Cat::create(['user_id'=> 1, 'name'=>'Google']);     //2
        Cat::create(['user_id'=> 1, 'name'=>'Martin']);     //3
        Cat::create(['user_id'=> 1, 'name'=>'Roller']);     //4
        Cat::create(['user_id'=> 1, 'name'=>'Säkerhet']);   //5

        Link::create(['user_id'=> 1, 'name'=>'GAN APP',
            'app_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://app.getanewsletter.com/signin']);

        Link::create(['user_id'=> 1, 'name'=>'GAN TEST',
            'app_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://app.gantest.com/']);

        Link::create(['user_id'=> 1, 'name'=>'GAN TEST ADMIN',
            'app_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://administration.gantest.com/']);

        Link::create(['user_id'=> 1, 'name'=>'GAN STAGE',
            'app_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://app.ganstage.com/']);

        Link::create(['user_id'=> 1, 'name'=>'GAN STAGE ADMIN',
            'app_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://administration.ganstage.com/']);

        Link::create(['user_id'=> 1, 'name'=>'TEST FOLDER',
            'folder_link'=>true, 'cat_id'=>2, 'fav'=>false,
            'link'=>'https://drive.google.com/drive/folders/1UvDIEdp2pCT6DTHb4P-LHU9LQEqLY8M4']);

        Link::create(['user_id'=> 1, 'name'=>'TEST DOCUMENTATION',
            'folder_link'=>true, 'cat_id'=>2, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1m09MCVxGX9Wnir-1ixpbuP7nkqyLNUSLsHBfl3i1zmk/edit#heading=h.kwd2e8cmtbr']);

        Link::create(['user_id'=> 1, 'name'=>'Google Workspace Dash',
            'app_link'=>true, 'cat_id'=>2, 'fav'=>false,
            'link'=>'https://workspace.google.com/u/0/appsdashboard?origin=user_dashboard']);

        Link::create(['user_id'=> 1, 'name'=>'Google Workspace Admin',
            'app_link'=>true, 'cat_id'=>2, 'fav'=>false,
            'link'=>'https://admin.google.com/']);

        Link::create(['user_id'=> 1, 'name'=>'Google Kalender',
            'app_link'=>true, 'cat_id'=>2, 'fav'=>false,
            'link'=>'https://calendar.google.com/calendar/u/0/r/week']);

        Link::create(['user_id'=> 1, 'name'=>'Google Mail',
            'app_link'=>true, 'cat_id'=>2, 'fav'=>false,
            'link'=>'https://mail.google.com/mail/u/0/#inbox']);

        Link::create(['user_id'=> 1, 'name'=>'Google Drive',
            'app_link'=>true, 'cat_id'=>2, 'fav'=>false,
            'link'=>'https://drive.google.com/drive/folders/0AIFjKWTLOlw6Uk9PVA']);

        Link::create(['user_id'=> 1, 'name'=>'My Google Drive',
            'app_link'=>true, 'cat_id'=>2, 'fav'=>false,
            'link'=>'https://drive.google.com/drive/my-drive']);


        // Documents
        Link::create(['user_id'=> 1, 'name'=>'Application Security Assessment: Identifying and Mitigating Vulnerabilities',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1U38Dd0L9k6vcaAJ2kiQiC4_4dPO8Bgaq1qFUhm6PUao/edit']);

        Link::create(['user_id'=> 1, 'name'=>'Produkt - Mötesprotokoll',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1nlUrXmUW6Kwa5_89ei48-XFNmtCSp8l7zCvjMle262o/edit']);

        Link::create(['user_id'=> 1, 'name'=>'Anteckningar',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1m09MCVxGX9Wnir-1ixpbuP7nkqyLNUSLsHBfl3i1zmk/edit#heading=h.qjlj8qj3j801']);

        Link::create(['user_id'=> 1, 'name'=>'Anställningsmall',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1F4MWqh5ZZHbWRLt1RNx6Xy81_sgXEKCOovScjJJieBo/edit#heading=h.dh9qtxwdp2f3']);

        Link::create(['user_id'=> 1, 'name'=>'Business rules',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1BUG-Wev93nHLIcwYwLvShV8mCUo3ptZlIJzuZIDyNug/edit#heading=h.5mmgwm7obcns']);

        Link::create(['user_id'=> 1, 'name'=>'CheckLista utveckling',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1vP8VwaztX5IykF56tEd0bEh3KmIa5_eJAv6HcfTCe1A/edit#heading=h.oz54kr20jlw2']);

        Link::create(['user_id'=> 1, 'name'=>'ToDo',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1tCe7EIwHck0mxgxeuL4LOVb4zSTukx6VTF6-YTEv54w/edit#heading=h.16uk9keqga1']);

        Link::create(['user_id'=> 1, 'name'=>'Roller och Ansvarsområden',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1rJ_aYKjOzAU-15Z-iwUli6B03QY99tOY8U8huu_ZyyE/edit#heading=h.qddqbcm77r9b']);

        Link::create(['user_id'=> 1, 'name'=>'Mötesprotokoll',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1WCV6bhJrCBNK0OUNXNUsWeV0HQmVvZbAOUmXJUMRfF8/edit']);

        Link::create(['user_id'=> 1, 'name'=>'Projectplan - Multi user setup',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1GJNBTDwN9xlgVzDsFWIhRRfDLeKWGSkA6zH-LGPRWfU/edit#heading=h.n3ffp6ce8w21']);

        Link::create(['user_id'=> 1, 'name'=>'Nystart',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1nfZCTrsKGOPztcAydH8eFaOkHaNsTEGyZkZC_cy5t98/edit']);

        Link::create(['user_id'=> 1, 'name'=>'Get a Newsletter master documentation 2020',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1MjNFYKEZygIMUm5Iw_z654_2_7AIgsngLa7viKftCe4/edit#heading=h.gbvj1ktr8kdm']);

        Link::create(['user_id'=> 1, 'name'=>'MM',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1cPgmkZck7rDdXieWSLP25DShmcQs4vffHoqzIicnYkA/edit#heading=h.ydel4rpilcjf']);

        Link::create(['user_id'=> 1, 'name'=>'Mallar',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1gVb8Lb_SPZeXJksHYR6OpzHJkqRioIr8wDwFeC6gdKQ/edit#heading=h.qvqivc6hb3ve']);

        Link::create(['user_id'=> 1, 'name'=>'Projektplansmall',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1fjN85rB4cKB_A6UwagxSh36rUCsC0iheclu-GlyqHhM/edit#heading=h.gnh9t4d6fdjr']);

        Link::create(['user_id'=> 1, 'name'=>'Services for scanning and security testing',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1spyyuAlqBkw5vkYxCm4c58cmz58F4YZTuXcj1qRhW8w/edit#heading=h.yhiji8vefhh3']);

        Link::create(['user_id'=> 1, 'name'=>'Budget',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/spreadsheets/d/1rJw8octHNvzIrNZNCcA9IbICB2-fK1NrAKSb99oOsC8/edit#gid=0']);

        Link::create(['user_id'=> 1, 'name'=>'Certifieringar',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1EX_DUdnhL54hIU2bXRNwaTXZHVY9nK8BvLZCwbQhzj0/edit#heading=h.52uxd0qatccf']);

        Link::create(['user_id'=> 1, 'name'=>'Product roadmap',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/spreadsheets/d/1tIdd5upn3E2hNUJGBE3x1w9t8fIgCnPwpN6uezzHCj8/edit#gid=471395083']);

        Link::create(['user_id'=> 1, 'name'=>'OKR',
            'document_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://docs.google.com/document/d/1pIhbgffDte0PWAqEBY2LaxHLCtsXspGO31iHQllpi04/edit']);


        // Folder
        Link::create(['user_id'=> 1, 'name'=>'Management',
            'folder_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://drive.google.com/drive/folders/1SPDmb0iTaEoSZKq9aJbekzLAKZgPNnrp']);

        Link::create(['user_id'=> 1, 'name'=>'Documents',
            'folder_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://drive.google.com/drive/folders/160w--W9OV16LwUStfoqQQVSPslzABKtZ']);

        Link::create(['user_id'=> 1, 'name'=>'Document templates',
            'folder_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://drive.google.com/drive/folders/1HaBueoHEwi83ddc-WFTSVC0vH4JZsADM']);

        Link::create(['user_id'=> 1, 'name'=>'Meetings',
            'folder_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://drive.google.com/drive/folders/1yd_PXbhkS_8b_bGUEDgT7baHMYhBZZ9k']);

        Link::create(['user_id'=> 1, 'name'=>'Processes',
            'folder_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://drive.google.com/drive/folders/1xEz5OOzhYzZBEHEVR0r8e7ubETZeLvpe']);


        // Application
        Link::create(['user_id'=> 1, 'name'=>'Linear',
            'app_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://linear.app/getanewsletter']);

        Link::create(['user_id'=> 1, 'name'=>'Avtalsmallar',
            'app_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://avtalsmallar.se']);

        Link::create(['user_id'=> 1, 'name'=>'Avtalsmallar ADMIN',
            'app_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://avtalsmallar.se/nova-admin/dashboards/main']);

        Link::create(['user_id'=> 1, 'name'=>'Fortnox',
            'app_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'http://fortnox.se']);

        Link::create(['user_id'=> 1, 'name'=>'SEB',
            'app_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://id.seb.se/ccs/mbid']);

        Link::create(['user_id'=> 1, 'name'=>'LOOPIA',
            'app_link'=>true, 'cat_id'=>1, 'fav'=>false,
            'link'=>'https://loopia.se']);

    }
}
