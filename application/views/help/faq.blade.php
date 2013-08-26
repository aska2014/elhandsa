<a href="{{ URL::home() }}"><div id="logo" style="margin-top:0px; float:right;"></div></a>
<div id="desc">
<h1>Frequently Asked Questions</h1>

<h3>What is the difference between Instructors, Doctors and Professors ?</h3>
<p>
	Instructors refer to both doctors and professors<br />
	There were alot of titles for the instructors in the database, So I had to shorten these titles to only doctors and professors.
</p>

<h3>Can doctors or professors see the posts in the students section ?</h3>
<p>
	No, Doctors and professors can only see posts you post in the "Professors & Doctors Posts" section.<br />
	The website is created by one of its students, The college is not part of it and has no access to the database, the source code or any information on the website.
</p>

<h3>When adding materials, what happens if I can't find the doctor or professor name ?</h3>
<p>
	Since the database containing the instructors hasn't been updated for about 3 years, sometimes you might not find the doctor and/or professor name, but there's a link bellow the titles "Doctor name" and "Professor name" that will navigate you to a page where you can add new doctor or professor.<br />
	Add new Doctor : <a href="{{ URL::to('instructors/add_doctor') }}" target="_blank">Click here</a><Br />
	Add new Professor : <a href="{{ URL::to('instructors/add_professor') }}" target="_blank">Click here</a><br />
</p>

<h3>Is my Information protected ?</h3>
<p>
	The private information is protected by a very secure one-way hash function which means it can't be decoded, for example this is how your password is saved in the database : <span style="color:#6FF">{{ Auth::user()->password }}</span>.<Br />
	The rest of your information is shared with your group and is visible to the database administrator such as your birthday, hoppies, ... etc. But you can choose to leave them empty.<br />
</p>

</div>