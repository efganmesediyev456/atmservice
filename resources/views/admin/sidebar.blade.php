<ul class = "nav nav-pills nav-sidebar flex-column"
    data-widget = "treeview"
    role = "menu"
    data-accordion = "false">


          <li class = "nav-item">
            <a href = "/admin/banknotes"
               class = "nav-link">
              <i class = "nav-icon fas fa-th"></i>
              <p>
                Banknotes

              </p>
            </a>
          </li>
            <li class = "nav-item">
            <a href = "/admin/users"
               class = "nav-link">
              <i class = "nav-icon fas fa-th"></i>
              <p>
                Users

              </p>
            </a>
          </li>
            <li class = "nav-item">
            <a href = "/admin/logs"
               class = "nav-link">
              <i class = "nav-icon fas fa-th"></i>
              <p>
                  Logs
              </p>
            </a>
          </li>
            <li class = "nav-item">
            <a style = "cursor: pointer"
               onclick = "document.querySelector('#logout').submit();"
               class = "nav-link">
              <i class = "nav-icon fas fa-th"></i>
              <p>
                  logout
              </p>
            </a>
                <form style="display: none" id = "logout"
                      action = "/admin/logout"
                      method = "POST">
                    @csrf

                </form>
          </li>
</ul>
