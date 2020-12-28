package acciones;

import com.opensymphony.xwork2.ActionSupport;
import persistencia.ProductoDAO;
import pojos.Producto;

public class EliminarChollo extends ActionSupport {
    
    private String idProducto;
    
    public EliminarChollo() {
    }

    public String getIdProducto() {
        return idProducto;
    }

    public void setIdProducto(String idProducto) {
        this.idProducto = idProducto;
    }
    
    public String execute() throws Exception {
        
        Producto p = new ProductoDAO().read(Integer.parseInt(getIdProducto()));
        
        p.setCategoria(null);
        p.setTienda(null);
        
        new ProductoDAO().delete(getIdProducto());
                
        return SUCCESS;
    }
    
}
