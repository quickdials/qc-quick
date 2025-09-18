<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Client\Client; //model
use Validator;
use Exception;

class BusinessLogoController extends Controller
{
	protected $danger_msg = '';
	protected $success_msg = '';
	protected $warning_msg = '';
	protected $info_msg = '';
	protected $redirectTo = '/business-owners';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Request $request)
	{

	}
	public function profileLogo(Request $request)
	{
		$clientID = auth()->guard('clients')->user()->id;
		$client = Client::find($clientID);
		return view('business.profileLogo', ['client' => $client]);
	}

	public function saveProfileLogo(Request $request, $id)
	{
		if ($request->ajax()) {
			$client = Client::find($request->input('business_id'));
			$id = $request->input('business_id');
			$validator = Validator::make($request->all(), [
				'image' => 'mimes:jpeg,jpg,png,svg|max:2048',
				'profile_pic' => 'mimes:jpeg,jpg,png,svg|max:2048'
			], [
				'profile_pic.dimensions' => 'Please upload Banner of given size -> [Minimum Height:319px] &amp; [Minimum Width:1137px].',
				'image.dimensions' => 'Please upload profile logo of given size -> .[Maximum Height:150px] &amp; [Maximum Width:300px]'
			]);

			if ($validator->fails()) {
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status' => 1, 'errors' => $errorsBag], 400);
			}

			try {
				if ($request->hasFile('image')) {
					$image = [];
					$filePath = getFolderStructure();
					$file = $request->file('image');
					$filename = str_replace(' ', '_', $file->getClientOriginalName()); // $file->getClientOriginalName();
					$destinationPath = public_path($filePath);
					$nameArr = explode('.', $filename);
					$ext = array_pop($nameArr);
					$name = implode('_', $nameArr);
					if (file_exists($destinationPath . '/' . $filename)) {
						$filename = $name . "_" . time() . '.' . $ext;
					}

					$imagePath = $file->getPathname();
					$targetWidth = 250;
					$targetHeight = 141;
					$quality = 75;

					$ext = strtolower($file->getClientOriginalExtension());

					// Load original image
					if ($ext === 'jpeg' || $ext === 'jpg') {
						$srcImage = imagecreatefromjpeg($imagePath);
					} elseif ($ext === 'png') {
						$srcImage = imagecreatefrompng($imagePath);
					} else if ($ext === 'svg') {
						$file->move($destinationPath, $filename);
					}
					if ($ext === 'jpeg' || $ext === 'jpg' || $ext === 'png') {

						list($width, $height) = getimagesize($imagePath);

						$newImage = imagecreatetruecolor($targetWidth, $targetHeight);

						imagecopyresampled(
							$newImage,
							$srcImage,
							0,
							0,
							0,
							0,
							$targetWidth,
							$targetHeight,
							$width,
							$height
						);


						$outputPath = public_path($filePath . "/" . $filename);
						imagejpeg($newImage, $outputPath, $quality);
						imagedestroy($srcImage);
						imagedestroy($newImage);
					}

					$image['large'] = array(
						'name' => $filename,
						'alt' => $filename,
						'width' => '',
						'height' => '',
						'src' => $filePath . "/" . $filename
					);

					if (!empty($client->logo)) {
						$oldImages = unserialize($client->logo);
					}
					$client->logo = serialize($image);
				}

				// PROFILE PICTURE
				// ***************
				if ($request->hasFile('profile_pic')) {
					$image = [];
					$filePath = getFolderStructure();

					$file = $request->file('profile_pic');
					$filename = str_replace(' ', '_', $file->getClientOriginalName());
					$destinationPath = public_path($filePath);
					$nameArr = explode('.', $filename);
					$ext = array_pop($nameArr);
					$name = implode('_', $nameArr);
					if (file_exists($destinationPath . '/' . $filename)) {
						$filename = $name . "_" . time() . '.' . $ext;
					}

					$imagePath = $file->getPathname();
					$targetWidth = 1200;
					$targetHeight = 180; 
					$quality = 75;

					$ext = strtolower($file->getClientOriginalExtension());

					// Load original image
					if ($ext === 'jpeg' || $ext === 'jpg') {
						$srcImage = imagecreatefromjpeg($imagePath);
					} elseif ($ext === 'png') {
						$srcImage = imagecreatefrompng($imagePath);
					} else if ($ext === 'svg') {
						$file->move($destinationPath, $filename);
					}
					if ($ext === 'jpeg' || $ext === 'jpg' || $ext === 'png') {

						 
						list($width, $height) = getimagesize($imagePath);			 
						$newImage = imagecreatetruecolor($targetWidth, $targetHeight);
						imagecopyresampled(
							$newImage,
							$srcImage,
							0,
							0,
							0,
							0,
							$targetWidth,
							$targetHeight,
							$width,
							$height
						);

						// Save compressed image
						$outputPath = public_path($filePath . "/" . $filename);
						imagejpeg($newImage, $outputPath, $quality);
						// Cleanup
						imagedestroy($srcImage);
						imagedestroy($newImage);
					}

					$image['large'] = array(
						'name' => $filename,
						'alt' => $filename,
						'width' => '',
						'height' => '',
						'src' => $filePath . "/" . $filename
					);

					if (!empty($client->profile_pic)) {
						$oldProfileImages = unserialize($client->profile_pic);
					}
					$client->profile_pic = serialize($image);
				}


				if ($client->save()) {

					$status = 1;
					$msg = "Profile Logo updated successfully !";
				} else {
					$status = 0;
					$msg = "Profile Logo could not be successfully, Please try again !";
				}

			} catch (Exception $e) {
				$status = 0;
				$msg = $e->getMessage();
			}
			return response()->json(['status' => $status, 'msg' => $msg], 200);

		}

	}

	public function logoDel($id)
	{

		$delet_data = Client::findOrFail($id);
		$clientID = auth()->guard('clients')->user()->id;
		$client = Client::find($clientID);

		if ($delet_data->logo != '') {
			$image = unserialize($delet_data->logo);

			$large = '' . $image['large']['src'];
			if (!empty($image['thumbnail']['src'])) {
				$thumbnail = '' . $image['thumbnail']['src'];
				if (file_exists($thumbnail)) {
					unlink($thumbnail);
				}
			}
			if (file_exists($large)) {
				unlink($large);
			}
		}

		$edit_data = array('logo' => "", );
		$del = Client::where('id', $id)->update($edit_data);
		return redirect('business/profile-logo');

	}


	public function profilePicDel($id)
	{

		$delet_data = Client::findOrFail($id);
		$clientID = auth()->guard('clients')->user()->id;
		$client = Client::find($clientID);
		if ($delet_data->profile_pic != '') {
			$image = unserialize($delet_data->profile_pic);
			$large = '' . $image['large']['src'];
			if (!empty($image['thumbnail']['src'])) {
				$thumbnail = '' . $image['thumbnail']['src'];
				if (file_exists($thumbnail)) {
					unlink($thumbnail);
				}
			}
			if (file_exists($large)) {
				unlink($large);
			}
		}
		$edit_data = array('profile_pic' => "", );
		$del = Client::where('id', $id)->update($edit_data);
		return redirect('business/profile-logo');

	}
	public function uploadPictures(Request $request)
	{
		$clientID = auth()->guard('clients')->user()->id;
		$client = Client::find($clientID);
		$search = [];
		if ($request->has('search')) {
			$search = $request->input('search');
		}
		return view('business.uploadPictures', ['search' => $search, 'client' => $client]);
	}

	public function saveGallary(Request $request)
	{
		if ($request->has('fourth_form_submit')) {
			$client = Client::find($request->input('business_id'));
			$id = $request->input('business_id');
			$image = [];
			if (!empty($client->pictures)) {
				$oldImages = unserialize($client->pictures);
			}
			$filePath = getFolderStructure();

			for ($i = 0; $i < 12; $i++) {
				if ($request->hasFile('image' . ($i + 1))) {

					$file = $request->file('image' . ($i + 1));

					$filename = str_replace(' ', '_', $file->getClientOriginalName());
					$destinationPath = public_path($filePath);
					$nameArr = explode('.', $filename);
					$ext = array_pop($nameArr);
					$name = implode('_', $nameArr);
					if (file_exists($destinationPath . '/' . $filename)) {
						$filename = $name . "_" . time() . '.' . $ext;
					}
				 


					$imagePath = $file->getPathname();
					$targetWidth = 800;   
					$targetHeight = 600;  
					$quality = 75;        

					$ext = strtolower($file->getClientOriginalExtension());

					// Load original image
					if ($ext === 'jpeg' || $ext === 'jpg') {
						$srcImage = imagecreatefromjpeg($imagePath);
					} elseif ($ext === 'png') {
						$srcImage = imagecreatefrompng($imagePath);
					} elseif ($ext === 'svg') {
						$file->move($destinationPath, $filename);
					}
					if ($ext === 'jpeg' || $ext === 'jpg' || $ext === 'png') {

						// Get original size
						list($width, $height) = getimagesize($imagePath);

						// Create new blank image
						$newImage = imagecreatetruecolor($targetWidth, $targetHeight);

						// Resize image
						imagecopyresampled(
							$newImage,
							$srcImage,
							0,
							0,
							0,
							0,
							$targetWidth,
							$targetHeight,
							$width,
							$height
						);

						// Save compressed image
						$outputPath = public_path($filePath . "/" . $filename);

						imagejpeg($newImage, $outputPath, $quality);  // For PNG, use imagepng()

						// Cleanup
						imagedestroy($srcImage);
						imagedestroy($newImage);

					}

					$image[$i]['large'] = array(
						'name' => $filename,
						'alt' => $filename,
						'width' => '',
						'height' => '',
						'src' => $filePath . "/" . $filename
					);
				} else if (isset($_FILES['image' . ($i + 1)]) && $_FILES['image' . ($i + 1)]['size'] == 0) {
				} else {
					if (isset($oldImages)) {
						if (array_key_exists($i, $oldImages)) {
							$image[$i] = $oldImages[$i];
						}
						unset($oldImages[$i]);
					}
				}
			}
			if (count($image) > 0) {
				$client->pictures = serialize($image);
			} else {
				$client->pictures = '';
			}

			if ($client->save()) {
				if (isset($oldImages)) {
					foreach ($oldImages as $oldImage) {
						try {
							if (!unlink(public_path($oldImage['large']['src'])))
								throw new Exception("Old files not deleted...");
							if (!unlink(public_path($oldImage['thumbnail']['src'])))
								throw new Exception("Old files not deleted...");
						} catch (Exception $e) {
							echo $e->getMessage();
						}
					}
				}
				$client = Client::find($id);


				$this->success_msg = 'Profile gallary Pic successfully!';
				$request->session()->flash('success_msg', $this->success_msg);
				return redirect("/business/gallery-pictures");
			} else {
				return redirect("/business/gallery-pictures");
			}
		}
	}
}
