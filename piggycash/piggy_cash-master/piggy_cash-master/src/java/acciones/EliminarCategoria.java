package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.CategoriaDAO;


public class EliminarCategoria extends ActionSupport implements SessionAware {
    
    Map<String, Object> SESION;
    
    private String nombreEliminarCategoria;

    public String getNombreEliminarCategoria() {
        return nombreEliminarCategoria;
    }

    public void setNombreEliminarCategoria(String nombreEliminarCategoria) {
        this.nombreEliminarCategoria = nombreEliminarCategoria;
    }
        
    
    public EliminarCategoria() {
    }
    
    @Override
    public String execute() throws Exception {
       
        new CategoriaDAO().delete(getNombreEliminarCategoria());
        
        getSESION().put("CATEGORIAS",  new CategoriaDAO().list());
        
       return SUCCESS;
    }
    
    public Map<String, Object> getSESION() {
        return SESION;
    }

    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }
    
}
