<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>

  <title>
    <?php
    $title = empty($title) ? "Poster" : $title;
    echo $title;
    ?>
  </title>

  <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'>
  <script defer src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script>

  <style>
    .file__preview img {
      max-height: 600px;
      object-fit: contain;
      object-position: center;
      filter: drop-shadow(0px 0px 2px rgba(0, 0, 0, 0.5));
    }

    .create__label--file {
      position: relative !important;
      display: block !important;
      margin: auto !important;
      cursor: pointer !important;
      transition: .2s ease-in-out !important;
      width: fit-content !important;
      left: 0 !important;
    }

    .create__input--file {
      opacity: 0 !important;
    }

    li {
      overflow: hidden;
    }

    .card-content {
      white-space: nowrap;
      text-overflow: clip;
    }

    .card-title {
      white-space: nowrap;
      text-overflow: clip;
    }

    .card-footer {
      position: absolute;
      bottom: 5%;
      left: 0;
      display: flex;
      justify-content: center;
      width: 100%;
    }

    .card-footer>*:not(:last-child) {
      margin-right: 4px;
    }

    .button-floating {
      z-index: 1000;
      position: fixed;
      bottom: 50px;
      right: 50px;
    }

    .materialboxed {
      height: 400px;
      object-fit: cover;
    }

    .materialboxed.active {
      object-fit: contain;
    }

    @media (max-width: 1000px) {
      .materialboxed {
        height: 450px;
      }
    }

    @media (max-width: 600px) {
      .materialboxed {
        height: 500px;
      }
    }
  </style>
</head>