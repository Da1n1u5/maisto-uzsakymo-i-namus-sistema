<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Naujo patiekalo sukurimo forma</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">
            .table th {
                text-align: center;
            }

            .table{
                border-radius: 5px;
                width: 50%;
                float: none;
                margin: 0px auto;
            }
            .btn-register {
                background-color: #1CB94E;
                outline: none;
                color: #fff;
                font-size: 14px;
                height: auto;
                font-weight: normal;
                padding: 14px 0;
                text-transform: uppercase;
                border-color: #1CB94A;
            }
        </style>
    </head>
    <body>

        <form  class="form-horizontal" action="process.php" method="POST" role="form" enctype="multipart/form-data">
            <fieldset>
                <legend>Patiekalo pridėjimo forma</legend>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_id">Patiekalo pavadinimas</label>
                    <div class="col-md-4">
                        <input id="dishname" name="dishname" placeholder="pvz: Lietiniai su varške" class="form-control input-md" required="" type="text">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_name">Patiekalo tipas</label>
                    <div class="col-md-4">
                        <input id="type" name="type" placeholder="pvz: Blynai" class="form-control input-md" required="" type="text">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_name_fr">Porcijų kiekis</label>
                    <div class="col-md-4">
                        <input id="servings" name="servings" placeholder="pvz: 2" class="form-control input-md" required="" type="number" min="0">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_categorie">Supakavimas</label>
                    <div class="col-md-4">
                        <input id="wraping" name="wraping" placeholder="pvz: dėžutėje" class="form-control input-md" required="" type="text">
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_categorie">Kaina(Eur)</label>
                    <div class="col-md-4">
                        <input id="price" name="price" placeholder="pvz: 29.56" class="form-control input-md" required="" type="text">
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label" for="filebutton">patiekalo nuotrauka</label>
                    <div class="col-md-4">
                        <input id="filebutton" name="filebutton" class="input-file" type="file">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>patiekalo produktai</legend>
                <div class="form-group">
                    <form name="add_name" id="add_name">
                        <div class="table-responsive">
                            <table class="table table-bordered " id="dynamic_field">
                                <tr>
                                    <th class="col-xs-3">Produkto pavadinimas</th>
                                    <th class="col-xs-3">Svoris</th>
                                    <th class="col-xs-3"></th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="name[]" placeholder="Tešla" class="form-control name_list" /></td>
                                    <td><input type="text" name="weight[]" placeholder="Svoris" class="form-control name_list" /></td>
                                    <td class="col-md-1"><button type="button" name="add" id="add" class="btn btn-success">Pridėti produktą</button></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton">Patvirtinti</label>
                    <div class="col-md-4">
                        <input type="submit" name="addDish" id="addDish" tabindex="4" class="form-control btn btn-register" value="Pridėti patiekalą">
                    </div>
                </div>
            </fieldset>
        </form>

    </body>

    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="name[]" placeholder="Tešla" class="form-control name_list" /></td><td><input type="text" name="weight[]" placeholder="Svoris" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
    </script>
</html>