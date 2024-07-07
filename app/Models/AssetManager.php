<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   AssetManager extends Staff
{
    use HasFactory;
    public function registerNewAsset(array $data)
    {

        $asset = Asset::create([
            'asset_name' => $data['asset_name'],
            'purchased_date' => $data['purchased_date'],
            'end_of_life' => $data['end_of_life'],

            'category_id' => $data['category_id'],
            'standard_id' => $data['standard_id'],
            'status_id' => $data['status_id'],
            'vendor_id' => $data['vendor_id'],
        ]);

        return $asset;
    }

    public function updateAssetDetails(Asset $asset, array $data)
    {
        // Validate data (omitted for brevity)

        $asset->update($data);

        return $asset;
    }

    public function removeRegisteredAsset(Asset $asset)
    {
        // Handle asset removal logic (e.g., soft delete, permanent delete)
        $asset->delete();
        return true; // Or appropriate success/failure response
    }

    public function manageAssetStatus(Asset $asset, string $newStatus)
    {
        $status = AssetStatus::where('status_name', $newStatus)->first();

        if (!$status) {
            throw new \Exception("Invalid asset status: $newStatus");
        }

        $asset->status()->associate($status);
        $asset->save();

        return $asset;
    }

    public function manageAssetStandard(Asset $asset, string $newStandard)
    {
        $status = AssetStatus::where('status_name', $newStandard)->first();
        if (!$status) {
            throw new \Exception("Invalid asset standard: $newStandard");
        }
        $asset->status()->associate($status);
        $asset->save();
        return $asset;
    }

    public function manageAssetCategories(Asset $asset, string $newStandard)
    {
        $status = AssetStatus::where('status_name', $newStandard)->first();
        if (!$status) {
            throw new \Exception("Invalid asset standard: $newStandard");
        }
        $asset->status()->associate($status);
        $asset->save();
        return $asset;
    }

    public function manageAssetVendor(Asset $asset, Vendor $newVendor)
    {
        $asset->save();
        return $asset;
    }

    public function assignAssetToStaff()
    {
    }

    public function generateCustomReport(){


    }
}
