package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.TiendaDAO;

public class EliminarTienda extends ActionSupport implements SessionAware {

    private String nombreEliminarTienda;

    Map<String, Object> SESION;

    public EliminarTienda() {
    }

    public String getNombreEliminarTienda() {
        return nombreEliminarTienda;
    }

    public void setNombreEliminarTienda(String nombreEliminarTienda) {
        this.nombreEliminarTienda = nombreEliminarTienda;
    }

    @Override
    public String execute() throws Exception {

         new TiendaDAO().delete(getNombreEliminarTienda());
        
        getSESION().put("TIENDAS",  new TiendaDAO().list());
        
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
