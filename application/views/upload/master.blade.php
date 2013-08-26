@layout('master.master')

@section('content')
<div id="upload_desc">

	<img src="{{ URL::to('public/img/upload.png') }}" width="100px;" />

	<h3>Step 1: <a href="{{ URL::to('login_mediafire') }}" target="_blank">Click here</a>,Then wait for a blank page to load and close it.</h3>
	<p>
		<em>You can skip this step If you done it before on this computer.</em><br />
		In this step we automatically log you in to elhandsa mediafire account.<br />
		You also can manually log in to the mediafire account with this username and password<br />
		<b>Email    </b>: <i>elhandsa2012@yahoo.com</i><br />
		<b>Password </b>: <i>portsaid2012</i>
	</p>

	<h3>Step 2: <a href="{{ Auth::user()->group->mediafire_folder }}" target="_blank">Click here</a> to go to your group folder and start uploading.</h3>
	<p>
		A folder has been made for each group in the college, by clicking the above link you will be navigated directly to your group folder.
	</p>

	<h3>Step 3: Copy the link after uploading and then paste it in the document URL field</h3> 
	<p>
		After you upload the file you have to copy link and paste it in the Document URL field and hit Upload Document
	</p>

	<h4>Notice : </h4>
	<p>
		You can upload the documents on any other file hosting site and copy the download link and paste it in the document URL field, but since all this files will be gathered later and uploaded on elhandsa website, It will be easier to upload it on one place ( follow the above steps ). 
	</p>


</div>
@endsection

@section('styles')
<style type="text/css">
#upload_desc{ text-align:center;padding:40px 50px; width:600px; margin: 0px auto; }
#upload_desc img{margin-bottom:20px;}
#upload_desc h3{color:#F33; text-align: left; }
#upload_desc p{text-align: justify; margin-bottom:60px; line-height: 22px;}
#upload_desc h3 a{color:#33F;}
#upload_desc h4{text-align: left;}
</style>
@endsection