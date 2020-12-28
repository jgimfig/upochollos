package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.AnuncioDAO;

public class EliminarAnuncio extends ActionSupport implements SessionAware{
    
    private String idEliminarAnuncio;
    
    Map<String, Object> SESION;
    
    public EliminarAnuncio() {
    }

    public String getIdEliminarAnuncio() {
        return idEliminarAnuncio;
    }

    public void setIdEliminarAnuncio(String idEliminarAnuncio) {
        this.idEliminarAnuncio = idEliminarAnuncio;
    }
    
    
    
    public String execute() throws Exception {
        new AnuncioDAO().delete(getIdEliminarAnuncio());
        
        getSESION().put("ANUNCIOS",  new AnuncioDAO().list());
        
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
