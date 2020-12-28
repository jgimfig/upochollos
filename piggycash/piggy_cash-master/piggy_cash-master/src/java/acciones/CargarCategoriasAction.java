package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.List;
import persistencia.CategoriaDAO;
import pojos.Categoria;


public class CargarCategoriasAction extends ActionSupport {

    String categorias;

    public CargarCategoriasAction() {
    }

    public String getCategorias() {
        return categorias;
    }

    public void setCategorias(String categorias) {
        this.categorias = categorias;
    }

    public String execute() throws Exception {

        /*
        SE MANDA A UN JSP QUE HACE LAS VECES DE DATA HANDLER, SE MANDA LA INFORMACIÓN DE FORMA ASINCRONA
        MEDIANTE AJAX
        */
        
        List<Categoria> listaCategorias = new CategoriaDAO().list();
        categorias = "";

        for (Categoria categoria : listaCategorias) {
            categorias += categoria.getNombre() + "_" + categoria.getColorFondo() + "_" + categoria.getColorBorde() + ",";
        }

        return SUCCESS;
    }

}
