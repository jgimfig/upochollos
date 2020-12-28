package acciones;

import com.opensymphony.xwork2.ActionSupport;

public class CargarPagPrincipal extends ActionSupport {

    private String categoria;

    public CargarPagPrincipal() {
    }

    public String getCategoria() {
        return categoria;
    }

    public void setCategoria(String categoria) {
        this.categoria = categoria;
    }

    public String execute() throws Exception {

        /*Es un intermediario para arrastrar la categoría seleccionada a la página principal*/

        return SUCCESS;
    }

}
