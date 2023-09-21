<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://viderlab.com
 * @since      1.0.0
 *
 * @package    ViderLab_Basset_Form
 * @subpackage ViderLab_Basset_Form/public/partials
 */
?>

<div class="viderlab-basset-form">
    <form action="" method="POST" id="FormHoteles">
        <div class="search-div">
            <div class="search-container">
                <div class="input-container">
                    <div class="search-group">
                        <div class="search-input-group margin-right">
                            <label>Destino</label>
                            <input type="text" class="search-input img-marker" placeholder="Ingrese una ciudad" id="hoteles_destino" data-id="" autocomplete="off">
                        </div>
                        <div class="search-input-group">
                            <label>Habitaciones</label>
                            <select name="" class="search-input img-bed" id="hoteles_habitaciones" autocomplete="off">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="search-input-group">
                        <label>Fechas</label>
                        <div class="search-group-dates">
                            <input type="date" class="search-input-date img-calendar" placeholder="Desde" id="hoteles_desde" autocomplete="off">
                            <input type="date" class="search-input-date img-calendar" placeholder="Hasta" id="hoteles_hasta" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div id="habitacion-container">
                    <div class="search-habitacion"  id="habitacion-1">
                        <div class="search-x">
                            <label>Habitacion 1</label>
                        </div>
                        <div class="search-group">
                            <div class="search-input-group margin-right">
                                <label>Adultos <span>(+ 12 años)</span></label>
                                <select name="" class="search-input img-user" id="hoteles_adultos-1" autocomplete="off">
                                    <option value="1">1</option>
                                    <option value="2" selected="selected">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                            <div class="search-input-group">
                                <label>Menores <span>(0 a 11 años)</span></label>
                                <select name="" class="search-input img-child" id="hoteles_menores-1" autocomplete="off">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
                            </div>
                        </div>

                        <div class="search-input-group" id="menores_contenedor-1">
                            <label>Edad de los menores</label>
                            <div id="menores_datos-1"  class="search-menores">

                            </div>
                        </div>
                    </div>

                    <div class="search-habitacion"  id="habitacion-2">
                        <div class="search-x">
                            <label>Habitacion 2</label>
                            <span class="search-close"><span class="dashicons dashicons-no"></span></span>
                        </div>
                        <div class="search-group">
                            <div class="search-input-group margin-right">
                                <label>Adultos <span>(+ 12 años)</span></label>
                                <select name="" class="search-input img-user" id="hoteles_adultos-2" autocomplete="off">
                                    <option value="1">1</option>
                                    <option value="2" selected="selected">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                            <div class="search-input-group">
                                <label>Menores <span>(0 a 11 años)</span></label>
                                <select name="" class="search-input img-child" id="hoteles_menores-2" autocomplete="off">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
                            </div>
                        </div>

                        <div class="search-input-group" id="menores_contenedor-2">
                            <label>Edad de los menores</label>
                            <div id="menores_datos-2"  class="search-menores">

                            </div>
                        </div>
                    </div>

                    <div class="search-habitacion" id="habitacion-3">
                        <div class="search-x">
                            <label>Habitacion 3</label>
                            <span class="search-close"><span class="dashicons dashicons-no"></span></span>
                        </div>
                        <div class="search-group">
                            <div class="search-input-group margin-right">
                                <label>Adultos <span>(+ 12 años)</span></label>
                                <select name="" class="search-input img-user" id="hoteles_adultos-3" autocomplete="off">
                                    <option value="1">1</option>
                                    <option value="2" selected="selected">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                            <div class="search-input-group">
                                <label>Menores <span>(0 a 11 años)</span></label>
                                <select name="" class="search-input img-child" id="hoteles_menores-3" autocomplete="off">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
                            </div>
                        </div>

                        <div class="search-input-group" id="menores_contenedor-3">
                            <label>Edad de los menores</label>
                            <div id="menores_datos-3"  class="search-menores">

                            </div>
                        </div>
                    </div>

                    <div class="search-habitacion" id="habitacion-4">
                        <div class="search-x">
                            <label>Habitacion 4</label>
                            <span class="search-close"><span class="dashicons dashicons-no"></span></span>
                        </div>
                        <div class="search-group">
                            <div class="search-input-group margin-right">
                                <label>Adultos <span>(+ 12 años)</span></label>
                                <select name="" class="search-input img-user" id="hoteles_adultos-4" autocomplete="off">
                                    <option value="1">1</option>
                                    <option value="2" selected="selected">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                            <div class="search-input-group">
                                <label>Menores <span>(0 a 11 años)</span></label>
                                <select name="" class="search-input img-child" id="hoteles_menores-4" autocomplete="off">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
                            </div>
                        </div>

                        <div class="search-input-group" id="menores_contenedor-4">
                            <label>Edad de los menores</label>
                            <div id="menores_datos-4"  class="search-menores">

                            </div>
                        </div>
                    </div>
                    <p class="disclaimer_buscadores">Las edades de los menores deben ser las vigentes al momento de finalizar el viaje.</p>
                </div>
            </div>
            <div class="search-button">
                <button type="submit" class="button">Buscar</button>
            </div>
        </div>
    </form>

</div>
