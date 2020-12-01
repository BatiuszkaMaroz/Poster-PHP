<?php
function renderPost($id, $title, $url, $content, $createdAt) {
  echo "
  <li class='col s12 m10 l6 xl4 offset-m1'>
    <div class='card'>
      <div class='card-image'>
        <img
          class='materialboxed'
          width='100%'
          src='$url'
        />
      </div>
      <div class='card-content'>
        <span class='card-title activator grey-text text-darken-4'
          >$title<i class='material-icons right'>more_vert</i></span
        >
      </div>
      <div class='card-reveal'>
        <span class='card-title grey-text text-darken-4'
          >$title<i class='material-icons right'>close</i></span
        >
        <p>
          $content
        </p>
        <footer class='card-footer'>
          <a href='/poster/pages/edit/?postId=$id' class='waves-effect waves-light btn'><i class='material-icons left'>edit</i>Edit</a>
          <form action='/poster/' method='POST'>
            <input type='hidden' value=$id name='deleteId'=>
            <button class='waves-effect waves-light btn red'><i class='material-icons left'>delete</i>Delete</button>
          </form>
        <footer/>
      </div>
    </div>
  </li>
  ";
}
