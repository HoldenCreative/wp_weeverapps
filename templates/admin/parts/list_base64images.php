<?php
/*
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	0.9.2
*   License: 	GPL v3.0
*
*   This extension is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.
*
*   This extension is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details <http://www.gnu.org/licenses/>.
*
*/


// default images

if(!$weeverapp->theme->socialIcon)
	$weeverapp->theme->socialIcon = "iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAqhJREFUeNrsW4ttgzAQdaoM4BHSDTwCnaCMwAh0gpIJ6AZ0A9oJ6AZ0A7qBswE1kpFQZOLv+QOcdFKUBJT3fP8jp3Ec0Z7lCe1cDgIOAg4JKhemJdOWKWU6CnTgn5f8+5uQjGm3AlimHb8+SSEWwEVEJGURhSPgS6X8vtFLAwB+qfWewc/aKLpg49NqKk/gZy0Ugm7jC3zmGfys5EG26ZliXwQMgQjoV9IsvSNnU6Zv4x6bOv0oskQRGfjedzP06uAev477Da/mTy1Pay5vseMaYvDRQxDLslaUojrHLtFBZoPM8oe5jikNv28nsMzps8sZgABTwZrvq8g30y+BlWLuanls+T8TgLdJqZXsB59RXDJNfq48C0zg3y17/r/UCMCOixYpAcdU2PH9bnsn4DcyfMnFAB35EaQ2bQJSG4IMkqlPr9oEpWgBH0zfJBZxC+2OUBZQKqbQYAMQyElQaziHuIQgAGIErgqk1fX/2GYBprP+eeih6zLOJQc4/czQ9XAIAiAGF6r9AzWwGqdSBjz9GiL4YR5UagVzIgF9nxhep5XPKSciE5ABAZ5q+HAPmfp6SSkKAX7UGFNVutMfXSGLgWK18EmM4FZfqiZ8n3Gs8n7NQTaSwEP4dymC2+BgxYOhyOHScy0FLdXH+soEvJOaP/Qi0wZ87crXaeTgcyRebDgNeL5JqA2jPVi154sEnSVljTzv+vFK/ndV4FSajUqHAj0TWDs+8dKwQys4cNCN7qNyeDAEPD/cTB707zlK5FHXUhIbdE37cndtEiRgbo4ii9A1zcqw7QUR1c3QNG7+ZPrM9IW/nt67ovi2QdFLVBbg240qQTyhvLAhWwavmlbbLYInK6myWim6Nmn6dNFm5wKCGk6G9z8+nI6/zu5cDgIOAnYu/wIMAAiZa5pHBTU3AAAAAElFTkSuQmCC";

if(!$weeverapp->theme->contactIcon)
	$weeverapp->theme->contactIcon = "iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAADb5pVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+Cjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDQuMi4yLWMwNjMgNTMuMzUyNjI0LCAyMDA4LzA3LzMwLTE4OjEyOjE4ICAgICAgICAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICAgeG1sbnM6eG1wUmlnaHRzPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvcmlnaHRzLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOklwdGM0eG1wQ29yZT0iaHR0cDovL2lwdGMub3JnL3N0ZC9JcHRjNHhtcENvcmUvMS4wL3htbG5zLyIKICAgeG1wUmlnaHRzOk1hcmtlZD0iRmFsc2UiCiAgIHhtcFJpZ2h0czpXZWJTdGF0ZW1lbnQ9Imh0dHA6Ly93d3cuYnJlbmRhbm1pdGNoZWxsLmNvbSIKICAgcGhvdG9zaG9wOkF1dGhvcnNQb3NpdGlvbj0iIj4KICAgPGRjOnJpZ2h0cz4KICAgIDxyZGY6QWx0PgogICAgIDxyZGY6bGkgeG1sOmxhbmc9IngtZGVmYXVsdCI+VGhpcyBpcyBvcGVuIGZvciBhbnlvbmUgdG8gaGF2ZSwgb3duICZhbXA7IHVzZS48L3JkZjpsaT4KICAgIDwvcmRmOkFsdD4KICAgPC9kYzpyaWdodHM+CiAgIDxkYzpjcmVhdG9yPgogICAgPHJkZjpTZXE+CiAgICAgPHJkZjpsaT5CcmVuZGFuIE1pdGNoZWxsPC9yZGY6bGk+CiAgICA8L3JkZjpTZXE+CiAgIDwvZGM6Y3JlYXRvcj4KICAgPGRjOnRpdGxlPgogICAgPHJkZjpBbHQ+CiAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ij5ibG9nLWljb248L3JkZjpsaT4KICAgIDwvcmRmOkFsdD4KICAgPC9kYzp0aXRsZT4KICAgPHhtcFJpZ2h0czpVc2FnZVRlcm1zPgogICAgPHJkZjpBbHQ+CiAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ii8+CiAgICA8L3JkZjpBbHQ+CiAgIDwveG1wUmlnaHRzOlVzYWdlVGVybXM+CiAgIDxJcHRjNHhtcENvcmU6Q3JlYXRvckNvbnRhY3RJbmZvCiAgICBJcHRjNHhtcENvcmU6Q2lBZHJFeHRhZHI9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkckNpdHk9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkclJlZ2lvbj0iIgogICAgSXB0YzR4bXBDb3JlOkNpQWRyUGNvZGU9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkckN0cnk9IiIKICAgIElwdGM0eG1wQ29yZTpDaVRlbFdvcms9IiIKICAgIElwdGM0eG1wQ29yZTpDaUVtYWlsV29yaz0iIgogICAgSXB0YzR4bXBDb3JlOkNpVXJsV29yaz0iIi8+CiAgPC9yZGY6RGVzY3JpcHRpb24+CiA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgCjw/eHBhY2tldCBlbmQ9InciPz4Z6Jaz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";

if(!$weeverapp->theme->pageIcon)
	$weeverapp->theme->pageIcon = "iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAADb5pVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+Cjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDQuMi4yLWMwNjMgNTMuMzUyNjI0LCAyMDA4LzA3LzMwLTE4OjEyOjE4ICAgICAgICAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICAgeG1sbnM6eG1wUmlnaHRzPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvcmlnaHRzLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOklwdGM0eG1wQ29yZT0iaHR0cDovL2lwdGMub3JnL3N0ZC9JcHRjNHhtcENvcmUvMS4wL3htbG5zLyIKICAgeG1wUmlnaHRzOk1hcmtlZD0iRmFsc2UiCiAgIHhtcFJpZ2h0czpXZWJTdGF0ZW1lbnQ9Imh0dHA6Ly93d3cuYnJlbmRhbm1pdGNoZWxsLmNvbSIKICAgcGhvdG9zaG9wOkF1dGhvcnNQb3NpdGlvbj0iIj4KICAgPGRjOnJpZ2h0cz4KICAgIDxyZGY6QWx0PgogICAgIDxyZGY6bGkgeG1sOmxhbmc9IngtZGVmYXVsdCI+VGhpcyBpcyBvcGVuIGZvciBhbnlvbmUgdG8gaGF2ZSwgb3duICZhbXA7IHVzZS48L3JkZjpsaT4KICAgIDwvcmRmOkFsdD4KICAgPC9kYzpyaWdodHM+CiAgIDxkYzpjcmVhdG9yPgogICAgPHJkZjpTZXE+CiAgICAgPHJkZjpsaT5CcmVuZGFuIE1pdGNoZWxsPC9yZGY6bGk+CiAgICA8L3JkZjpTZXE+CiAgIDwvZGM6Y3JlYXRvcj4KICAgPGRjOnRpdGxlPgogICAgPHJkZjpBbHQ+CiAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ij5ibG9nLWljb248L3JkZjpsaT4KICAgIDwvcmRmOkFsdD4KICAgPC9kYzp0aXRsZT4KICAgPHhtcFJpZ2h0czpVc2FnZVRlcm1zPgogICAgPHJkZjpBbHQ+CiAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ii8+CiAgICA8L3JkZjpBbHQ+CiAgIDwveG1wUmlnaHRzOlVzYWdlVGVybXM+CiAgIDxJcHRjNHhtcENvcmU6Q3JlYXRvckNvbnRhY3RJbmZvCiAgICBJcHRjNHhtcENvcmU6Q2lBZHJFeHRhZHI9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkckNpdHk9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkclJlZ2lvbj0iIgogICAgSXB0YzR4bXBDb3JlOkNpQWRyUGNvZGU9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkckN0cnk9IiIKICAgIElwdGM0eG1wQ29yZTpDaVRlbFdvcms9IiIKICAgIElwdGM0eG1wQ29yZTpDaUVtYWlsV29yaz0iIgogICAgSXB0YzR4bXBDb3JlOkNpVXJsV29yaz0iIi8+CiAgPC9yZGY6RGVzY3JpcHRpb24+CiA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgCjw/eHBhY2tldCBlbmQ9InciPz4Z6JazAAAEUUlEQVR42uxb7VHjMBAVmfw/d4CvAtwB7gBRAaaCCxXgqyBcBeYqCFSgUAF0kFCBcxXk7Bn5ZllWWtmWrJi5ndEQEsVo3779ksTZ8XgU/6W/FM3YNOMYaRSxFE+aoSIqHhWEVvnXE1E+CgjqxJT3AsLScZ5sRk68/9CM5wnAv7EoWumfjyEXQAU8OSH7ytjugP/YeuL4U4Zyh8XABT2LuLI1UL7qC8JCzFdufYAwZwC8gDB3AEaD8BUAGAXCVwFgMAhfCQAOhFGpG+fbPHIdUDPzK0OdUM0VgHzAGryCsOuBfqhOFCvyqt+fBIRU07DUr2MIpcxOB7h0SneIJalmn89Wej03EIoA+wmzE+mTCWeeqNmODASlfTOemnEIGBRXeqNkVEw6G2GFK52KTAtoQbjTQITOEJnj3Gys3xcoJc4t0ORDY4AcoPgpppzeACSW/KuI93aoUDk1EHoBQJ0D1KDwqImqTKFSFYNXzAWAlKB8BaK8Qpan3s+JSqyOWEk6A0BZvrAUIzACK0OzAp+nLCVr3SOiBwNAIYtllsaotHw3R+mH6+Q6l1rFBAD33dJSitZEN6YsSkJX2Bhy9CqmC6TogxXDjpL5PCfiCnx+yiw0mxoAxfgpViDpCQBmgcnaq4BZ4xMAS/BBjgKhIoJjJwcLjTtZE70AtHpbSj8YgjD1Ooh0ANygGv5gYACcM0T24DmmLa0WlAu9hscY202pw7aYaQ7nAq5zIGWTkC6wQIt4M1g3AUrvRzCglReDy2B51WDtQhZPLQCX4PffljZyLP2p7587ZIFEBNyFXiDltg7fefMIgIkBWxSHtqEAWBIuYLJIJ388AmCT7xqgvQfWWRngy7K+ATgQTAiWBgWTms7R69ySUVwCnIukoM2+Drm1FvOKm2K232xlt9dKsKOmKQtcAqtvUSqDAndp2yLm3TDv3pEBk4jLmV/paA2XIidxZEDp0Dd4KYQOYGFJoNQnBsSGiykC9AI9PLNEZGphITOCz+LLCsAL6tC4haYeaNjJu0V5X6U3CwBML3JE9SY8UltOUQVCF9gD60pLecoB1ZcBb5Zs0knQW6lL0ATdgxTFWfmHYU6KlMCZ4Jv4eIC6N+R/SP/QZ4v/MoDvywdDzgzxOibbEmuj/C9UoFwTdXgFrPOT8M81YMYdQXHFtN5rxJBJdoQg+jumSCmZz22FECxtd0zpG+omWi6YcwE8oWIoKh0BwOAWRNqb4iCVBUCIj9vS1GJKQZ8L2gBYW6yPr7y4XH8LCkDn67hrSwws2DAASGE+bcJgh1QeG4I9Hscg1IC60sASDEBmACsVn+8XhFZeEspvuDtCKyJdbXXGuERd2qNWrLP8gwYsAUXPra4hCuKZ1w67P0MD45Who7x19RvqekzfKzOm+S6bHVmAOkX1TZGl50WoHo2V7/9THuxuHRBjL0z1pfLGM/BeYk2mwVAMM5SOI3LEH/bhAhuqtP4rwAAXP9PgSB6NOgAAAABJRU5ErkJggg==";

if(!$weeverapp->theme->photoIcon)
	$weeverapp->theme->photoIcon = "iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAADb5pVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+Cjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDQuMi4yLWMwNjMgNTMuMzUyNjI0LCAyMDA4LzA3LzMwLTE4OjEyOjE4ICAgICAgICAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICAgeG1sbnM6eG1wUmlnaHRzPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvcmlnaHRzLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOklwdGM0eG1wQ29yZT0iaHR0cDovL2lwdGMub3JnL3N0ZC9JcHRjNHhtcENvcmUvMS4wL3htbG5zLyIKICAgeG1wUmlnaHRzOk1hcmtlZD0iRmFsc2UiCiAgIHhtcFJpZ2h0czpXZWJTdGF0ZW1lbnQ9Imh0dHA6Ly93d3cuYnJlbmRhbm1pdGNoZWxsLmNvbSIKICAgcGhvdG9zaG9wOkF1dGhvcnNQb3NpdGlvbj0iIj4KICAgPGRjOnJpZ2h0cz4KICAgIDxyZGY6QWx0PgogICAgIDxyZGY6bGkgeG1sOmxhbmc9IngtZGVmYXVsdCI+VGhpcyBpcyBvcGVuIGZvciBhbnlvbmUgdG8gaGF2ZSwgb3duICZhbXA7IHVzZS48L3JkZjpsaT4KICAgIDwvcmRmOkFsdD4KICAgPC9kYzpyaWdodHM+CiAgIDxkYzpjcmVhdG9yPgogICAgPHJkZjpTZXE+CiAgICAgPHJkZjpsaT5CcmVuZGFuIE1pdGNoZWxsPC9yZGY6bGk+CiAgICA8L3JkZjpTZXE+CiAgIDwvZGM6Y3JlYXRvcj4KICAgPGRjOnRpdGxlPgogICAgPHJkZjpBbHQ+CiAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ij5ibG9nLWljb248L3JkZjpsaT4KICAgIDwvcmRmOkFsdD4KICAgPC9kYzp0aXRsZT4KICAgPHhtcFJpZ2h0czpVc2FnZVRlcm1zPgogICAgPHJkZjpBbHQ+CiAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ii8+CiAgICA8L3JkZjpBbHQ+CiAgIDwveG1wUmlnaHRzOlVzYWdlVGVybXM+CiAgIDxJcHRjNHhtcENvcmU6Q3JlYXRvckNvbnRhY3RJbmZvCiAgICBJcHRjNHhtcENvcmU6Q2lBZHJFeHRhZHI9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkckNpdHk9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkclJlZ2lvbj0iIgogICAgSXB0YzR4bXBDb3JlOkNpQWRyUGNvZGU9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkckN0cnk9IiIKICAgIElwdGM0eG1wQ29yZTpDaVRlbFdvcms9IiIKICAgIElwdGM0eG1wQ29yZTpDaUVtYWlsV29yaz0iIgogICAgSXB0YzR4bXBDb3JlOkNpVXJsV29yaz0iIi8+CiAgPC9yZGY6RGVzY3JpcHRpb24+CiA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgCjw/eHBhY2tldCBlbmQ9InciPz4Z6JazAAAB/ElEQVR42uya7W2DMBCGnaoDMAIjMAKZIHSC0glKJigb0A1IJ2g3CBvQDZINmg0oVg8VVVicC9jYvCfdn+QS7Mfn+0pE0zSi01YahzUWGtLt+U5sXAAAADYu9wybY6ufK1pz1GphEoDcfIUrsOErsDaR3riDBwCA/SsQUER2VaqpAOTmzw4D2OEKAAAAAMAShZBTvcMSAJzqHRADAAAAjAajstWL+Jniyioys06AMRaPFR+NNexToR5n19RXLCWD6zQ5Fo/p5Mc8w9sr8MywSWx1lqY8YE475wAEM9s5B+CqUUF6CeCNYXOzVT6bAPDKON0jQfASgNzYg+KE5XtPrZ58aodVcWBPqS7pvfZh6+RNA+gHujXNCtAMYSTm8NpDarI6OWnUHMa7wbkry2LguV9/gLC6Qdc8IKA5QqR4r9QNtJwYcO6Rsy0Fo2t89zUIZgoXH4oNuW8A5KZeNOwffQNQarbLIdNbnACQ/TOzHNZYB0R0kjdmpNZ1/b4kHK8x5QHyBOU4vKasUlPezmd2/aHnTi6EGkUa5BZC6ch31oqFlmL6P8jLsUJoaQCpxmJryvO5+P3xZKpebFaCsdCb90di/tF4OHaFlooBgbD4Y8cAWKNZIKJCJFwJgIPpIOiEqmLAfusDkQojMQAAAAAAAAAAAAAAAADYhnwLMAAHhYfWORVpWgAAAABJRU5ErkJggg==";

if(!$weeverapp->theme->blogIcon)
	$weeverapp->theme->blogIcon = "iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAADb5pVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+Cjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDQuMi4yLWMwNjMgNTMuMzUyNjI0LCAyMDA4LzA3LzMwLTE4OjEyOjE4ICAgICAgICAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICAgeG1sbnM6eG1wUmlnaHRzPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvcmlnaHRzLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOklwdGM0eG1wQ29yZT0iaHR0cDovL2lwdGMub3JnL3N0ZC9JcHRjNHhtcENvcmUvMS4wL3htbG5zLyIKICAgeG1wUmlnaHRzOk1hcmtlZD0iRmFsc2UiCiAgIHhtcFJpZ2h0czpXZWJTdGF0ZW1lbnQ9Imh0dHA6Ly93d3cuYnJlbmRhbm1pdGNoZWxsLmNvbSIKICAgcGhvdG9zaG9wOkF1dGhvcnNQb3NpdGlvbj0iIj4KICAgPGRjOnJpZ2h0cz4KICAgIDxyZGY6QWx0PgogICAgIDxyZGY6bGkgeG1sOmxhbmc9IngtZGVmYXVsdCI+VGhpcyBpcyBvcGVuIGZvciBhbnlvbmUgdG8gaGF2ZSwgb3duICZhbXA7IHVzZS48L3JkZjpsaT4KICAgIDwvcmRmOkFsdD4KICAgPC9kYzpyaWdodHM+CiAgIDxkYzpjcmVhdG9yPgogICAgPHJkZjpTZXE+CiAgICAgPHJkZjpsaT5CcmVuZGFuIE1pdGNoZWxsPC9yZGY6bGk+CiAgICA8L3JkZjpTZXE+CiAgIDwvZGM6Y3JlYXRvcj4KICAgPGRjOnRpdGxlPgogICAgPHJkZjpBbHQ+CiAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ij5ibG9nLWljb248L3JkZjpsaT4KICAgIDwvcmRmOkFsdD4KICAgPC9kYzp0aXRsZT4KICAgPHhtcFJpZ2h0czpVc2FnZVRlcm1zPgogICAgPHJkZjpBbHQ+CiAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ii8+CiAgICA8L3JkZjpBbHQ+CiAgIDwveG1wUmlnaHRzOlVzYWdlVGVybXM+CiAgIDxJcHRjNHhtcENvcmU6Q3JlYXRvckNvbnRhY3RJbmZvCiAgICBJcHRjNHhtcENvcmU6Q2lBZHJFeHRhZHI9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkckNpdHk9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkclJlZ2lvbj0iIgogICAgSXB0YzR4bXBDb3JlOkNpQWRyUGNvZGU9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkckN0cnk9IiIKICAgIElwdGM0eG1wQ29yZTpDaVRlbFdvcms9IiIKICAgIElwdGM0eG1wQ29yZTpDaUVtYWlsV29yaz0iIgogICAgSXB0YzR4bXBDb3JlOkNpVXJsV29yaz0iIi8+CiAgPC9yZGY6RGVzY3JpcHRpb24+CiA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgCjw/eHBhY2tldCBlbmQ9InciPz4Z6JazAAADeUlEQVR42uRbS3KbQBBty1lkSXZZkhOEGxidwMouS47AEcgJ5JyA8glkL7PCPoHkE6CcAGWXnTOkhsqYCKa754fgVfVCojQzPHpefxhdgTtkwmLl80HYSdhR2uxRCXsdsfb6VthGWLREAvq2k14TLZUA1Uph6ZIJ6GwvvWKxBKhEpEsmQNWJaMkEtNbY3BbXDgm4EvYi7Fl+PvbyAi7ey9CZCPsh7PelbY1Y3kCbA9QWtCG59GiRGJLRzIEENX3makcGM0LK9IhZkdCikC5OIWFDVepzIhX3KjgOtnJvtmP8UqrAJ4Zo7gj7vF3vWs5LnqiymHxUmkowJ4bFLVEYSWtONK7WMGI4VswqgttmxBBpdbGl40ywRub7FBIKzEIjwoA+UuEK4W0UErSkpoTBEg8EYPP9jOBZ1ghIPRHQ2VYzR25jK0yZAIz27EyiwrXcb9gM6p7Q0VWrwZOs4jjhNJFrfBy43laEXzVjt3N/HBrDlQcM5Ro5M80tLXhxHJqA/rzUbTK2l0uupoQiQBWyxsIaYsQ4Z7UgNAHdPt8Twlo0UjyRK8YpENAlZFgStiNj6Lyg6it12v9yBOteNde1t6JeNXZgVpKRXAsm4fo0EJFKRFR781uuB2QItvfSLWMiCbVBVEgQv81Nt0AKvDAWEzSBHdYQW2lnSsAe3Pf0MfV/wUyRGxMCYg/pLVbQagMP+qszK2Y2Z6P7qyOhFdDviLWcE0yMALMJOIEdYEi4Q2aU56DrPX7mEnCwTMJGQ/aDZoybge9fXHkAIFyTglJTyT068oDYhICC03YeEbtc43G633MrU+NUOLfU+Gg0i+Wm6Noe58rw6d3J9PhK2gdhX4D+8iPSaMEBHGFlebxOtNaSCIpY3niIPP8J4TuH1d2D0rPDpr9jrbjnketDbbpvmJDuuhymaIR3rDzMcQ8Thg8CjkQxnB0BvuuMiybgEIIASoi5ZcxxCxcAyitsKmqHY1sDpcNTEGsGyjHYYKAcP8GexsqIY+YhCdgwCphiIGxFDEJfQ0QAgLenxGrGIrrc/6fSZUkZ8fxJ1g9BkYGb092h3zg5UWybVsGEkHq++SbU3rcZEUwsg4mi9HDzJUwc5ZJv3iUJBVwYNkA/sm5yFHaSiIB3dr9T+gJm8pfYCP6906s1T7sE4p8XQqfCXCTK0z2FaGqY4I8AAwAn9sQXKdHVJAAAAABJRU5ErkJggg==";


if(!$weeverapp->theme->calendarIcon)
	$weeverapp->theme->calendarIcon = "iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAArxJREFUeNrsm4FVwjAQQFMfA7ABZQLqBNYJZAPLBNYJwAl0g+IE1QnACdAJWieADWoOUzny0pC0PFvSu/dOkPYC93O5XJqWFUXBQGvIkOuKa4H02cI2kWwT8bmJwPdske3KwvZP9n43AJBKDpQaGTqgsjUBGFXYpnUAXLH6UkXcN7ANLD83aX9Yx4kmAJyQgYYmhNpEIv7KdWnR/jPq1Sa2n1wfLWzht9+j/3OuX+L7dzoA4Pica1zR8IclYHAgPIOtrfgVtgD1hetTCeJKkdVjx6M+xrMGBjA3TEJ1E+UEvd9VnL/7JwiB8PdoGiwMdHViOtqinOFLxzJkG1a0j8M2k47hdrcnpt+ViT/gt1fWAJ7nmRYDM5TMgOQU9V6ZZMrhJEfUUtiXjkTSsVy8TxT1BCTCW9R+hCLsTRwvOyYxrAM82wjARUfVfAy9uDkRRbo6QNd7G01i9DXF2VkjQO4V0G+uN+JH+Ia2ubD9EvkhsLTNxcwyErbW+QsioCmAixYAQJWg5ti6RvHSZblR5g9NElw41tkLVRLs/RAgAASAABAAAkAA2pVEsdTuDYAYLXtDZnZJ3RkAsHqT9wFGfQEQtBXyXQAwZTW3si4dgC8SXtoV508th8/p+LyNBNeFCICxvlE4Dxc2Z30AcKcI9/Lq7rIPAF7ZYbMDXmF/75odLmE7nwNyrmMxFNZ9LYV3XXWeFkMEgAAQAAJAAAgAASAABIAAtCbyqvC9bwBm7HBn2Esby+RBByJgTDmgRRlc4G/22e+GyrCGnRMAIna4O5WGQB+HgCxPhucpb5NzAcDC4ryQhgABIAAEwBTAPevQNnZDGbLjx+iUs8BaypJQOW3ENJN3yBn5NprQoAJ8UFSC6/1fdLc47N+pHkZyUcHPQPXwNEDIHHc+E35qnx6Hejt1zPGUSTdqgN8/AgwARBrV4A6mNboAAAAASUVORK5CYII=";

if(!$weeverapp->theme->videoIcon)
	$weeverapp->theme->videoIcon = "iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAADb5pVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+Cjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDQuMi4yLWMwNjMgNTMuMzUyNjI0LCAyMDA4LzA3LzMwLTE4OjEyOjE4ICAgICAgICAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICAgeG1sbnM6eG1wUmlnaHRzPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvcmlnaHRzLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOklwdGM0eG1wQ29yZT0iaHR0cDovL2lwdGMub3JnL3N0ZC9JcHRjNHhtcENvcmUvMS4wL3htbG5zLyIKICAgeG1wUmlnaHRzOk1hcmtlZD0iRmFsc2UiCiAgIHhtcFJpZ2h0czpXZWJTdGF0ZW1lbnQ9Imh0dHA6Ly93d3cuYnJlbmRhbm1pdGNoZWxsLmNvbSIKICAgcGhvdG9zaG9wOkF1dGhvcnNQb3NpdGlvbj0iIj4KICAgPGRjOnJpZ2h0cz4KICAgIDxyZGY6QWx0PgogICAgIDxyZGY6bGkgeG1sOmxhbmc9IngtZGVmYXVsdCI+VGhpcyBpcyBvcGVuIGZvciBhbnlvbmUgdG8gaGF2ZSwgb3duICZhbXA7IHVzZS48L3JkZjpsaT4KICAgIDwvcmRmOkFsdD4KICAgPC9kYzpyaWdodHM+CiAgIDxkYzpjcmVhdG9yPgogICAgPHJkZjpTZXE+CiAgICAgPHJkZjpsaT5CcmVuZGFuIE1pdGNoZWxsPC9yZGY6bGk+CiAgICA8L3JkZjpTZXE+CiAgIDwvZGM6Y3JlYXRvcj4KICAgPGRjOnRpdGxlPgogICAgPHJkZjpBbHQ+CiAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ij5ibG9nLWljb248L3JkZjpsaT4KICAgIDwvcmRmOkFsdD4KICAgPC9kYzp0aXRsZT4KICAgPHhtcFJpZ2h0czpVc2FnZVRlcm1zPgogICAgPHJkZjpBbHQ+CiAgICAgPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ii8+CiAgICA8L3JkZjpBbHQ+CiAgIDwveG1wUmlnaHRzOlVzYWdlVGVybXM+CiAgIDxJcHRjNHhtcENvcmU6Q3JlYXRvckNvbnRhY3RJbmZvCiAgICBJcHRjNHhtcENvcmU6Q2lBZHJFeHRhZHI9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkckNpdHk9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkclJlZ2lvbj0iIgogICAgSXB0YzR4bXBDb3JlOkNpQWRyUGNvZGU9IiIKICAgIElwdGM0eG1wQ29yZTpDaUFkckN0cnk9IiIKICAgIElwdGM0eG1wQ29yZTpDaVRlbFdvcms9IiIKICAgIElwdGM0eG1wQ29yZTpDaUVtYWlsV29yaz0iIgogICAgSXB0YzR4bXBDb3JlOkNpVXJsV29yaz0iIi8+CiAgPC9yZGY6RGVzY3JpcHRpb24+CiA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgCjw/eHBhY2tldCBlbmQ9InciPz4Z6JazAAACsUlEQVR42uxbgU3rMBB1UAcIExA2SCf4yQQfNggTABPAn6DdoN0gnwkaJmiZoGaCHybotyUbGevOdmmp0/hOOlW1Xt345fx8PifZbrdj2rIsa8RHwcZtSzFm/vlNEqBd2Eo2jdwrc8wXLHEjAogAt/XCH4XXwu+EbwKxtx6stD8GtvNg5wb2r0/kFLYOwHpF8MaCFw5xaSxs7sA+A9gtgl0Al41hWwC7OkQEbQa5A8uBiMDubAdgsb5fAq5L2xvQ9nruGtADbR8piWAeUwQrQAMwK4ALLwP7dfX9C2j7jWCvAn//aRMPAa1S/14N6MmBnVlaMHPcvXuF48Z3jIAHFfKdgcWIlUL8bmArhOzgVYBSYcoEiQAiYNTmWwU2Kr8/VyuN1elbBPQBGxWaAkQAEUAEhFiROgFbVQjJU54CT4qIJmUNkBEgy1xr705t5CJYqt3nIqY+DGEVaFQ0RNGHoSyDutgiibhJOQ+QU6FVU6NMORGqVDQsWOSi6BD0QecPyabCMgLuf0obzoGApfApCznn+4ZNBjxwXYz50XrEEAnQp8zLU/zZ0AiQR+ZzBp8HjpoAGebyBIqf+o9jE8DVwLtYF3AReZ5fs8hF1xgRMFdzvR/C3JuceJ4/Mv+zQ6MloB5iskFVYSKACEjbfCKoC5fnavmhBMgOKpoCRAARQASkSsBSeGb43JPrXxrYOwd2sweWq12jxtaeXebUwE69my7Pk6IF9BPEodUCe64fqvCuEewDgG0RLPRA1Iwd8KQoP0LBA7tTIW0M2T2+IdiPwDbSgFACDj2Wyo/QL3RGeHU0Bjwa8GzBG4cG2O/2VA5sCwwSw64twiT2H4LdWljoXaQvGpBZr86uADHbGPPTlxbvg+WGRuyDLT0R1Bu6AWFrMeYuNALofQHKBImAcdt/AQYA6wby0HSk7JoAAAAASUVORK5CYII=";



