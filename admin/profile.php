<?php
  error_reporting(0);
  session_start();
 echo" <a href='#' role='button' class='dropdown-toggle' data-toggle='dropdown'> <i class='icon-user'></i> $_SESSION[namauser] <i class='caret'></i>

                                </a><ul class='dropdown-menu'>
                                    <li>
                                        <a tabindex='-1' href='bagian.php?halamane=password'>Ganti Password</a>
                                    </li>
                                    <li class='divider'></li>
                                    <li>
                                        <a tabindex='-1' href='logout.php'>Logout</a>
                                    </li>
                                </ul>";

?>
