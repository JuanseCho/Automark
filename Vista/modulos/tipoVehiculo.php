<div class="container">
    <div class="row">
        <div class="col-md-2">
            <form action="needs-validation" id="form_R_TVehiculo" novalidate>
                <label for="txt_Veiculo" class="form-label">tipo vehiculo</label>
                <input type="text" id="txt_Veiculo" src="" placeholder="tipo de vehiculo">

                <button type="submit" id="Btn_R_Vehiculo" class="button">
                    <span>registrar</span>
                    <svg width="20" height="20" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="37" cy="37" r="35.5" stroke="black" stroke-width="3"></circle>
                        <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="black"></path>
                    </svg>
                </button>
            </form>
        </div>
        <div class="col-md-2">
            <form action="needs-validation" id="form_Edit_TVehiculo" novalidate>
                <label for="txt_Edit_Veiculo" class="form-label">tipo vehiculo</label>
                <input type="text" id="txt_Edit_Veiculo" src="" placeholder="tipo de vehiculo">

                <button type="submit" id="Btn_Edit_Vehiculo" idtipovehiculo="" class="button">
                    <span>Actualizar</span>
                    <svg width="20" height="20" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="37" cy="37" r="35.5" stroke="black" stroke-width="3"></circle>
                        <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="black"></path>
                    </svg>
                </button>
            </form>
        </div>
        <div class="col md-4 table-responsive">
            <div class="mt-3 p-3 bg-danger text-white rounded">

                <h2>Panel Administrativo de los tipos de vehiculo</h2>
            </div>


            <table id="tablaTipo_vehiculo" class="table table-striped ">
                <thead>
                    <tr>
                        <th>tipo vehiculo</th>
                        <th>acciones</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>