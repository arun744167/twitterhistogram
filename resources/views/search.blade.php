<div>
    <h3> Search tweet by userId </h3>
    <form action="/usersearch" method="post" enctype="multipart/form-data" class="ui form">
        @csrf
        <div class="ui input" >
            <input type="text" name="userid" placeholder="Search..."/>
        </div>
        <input class="ui blue button"  type="submit" name="Search" />
    </form>
</div>
