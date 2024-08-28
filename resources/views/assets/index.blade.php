<x-layout :sectionName="__('Manage')" :pageName="__('Assets')">
    <x-tabs :assets="$assets" :requests="$requests" :changes="$changes" :assigned="$assigned" :approvedReq="$approvedReq" :approvedChange="$approvedChange"></x-tabs>
    <x-assets-actions></x-assets-actions>
    <x-assets-registered :assets="$assets"></x-assets-registered>
    <x-assets-requests :requests="$requests" :changes="$changes"></x-assets-requests>
    <x-assets-assigned :assigned="$assigned"></x-assets-assigned>
    <x-assets-approved :approvedReq="$approvedReq" :approvedChange="$approvedChange"></x-assets-approved>

</x-layout>
