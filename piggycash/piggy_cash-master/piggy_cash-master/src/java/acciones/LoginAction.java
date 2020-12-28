package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.UsuarioDAO;
import pojos.Usuario;

public class LoginAction extends ActionSupport implements SessionAware{

    private String usuario;
    private String contrasena;
    
    Map<String, Object> SESION;

    public LoginAction() {
    }

    public String getUsuario() {
        return usuario;
    }

    public void setUsuario(String usuario) {
        this.usuario = usuario;
    }

    public String getContrasena() {
        return contrasena;
    }

    public void setContrasena(String contrasena) {
        this.contrasena = contrasena;
    }

    public void validate() {

        if (this.getUsuario() == null) {
            addFieldError("usuario", getText("usuario.error"));
        } else if ("".equals(this.getUsuario())) {
            addFieldError("usuario", getText("usuario.error"));
        }

        if (this.getContrasena() == null) {
            addFieldError("contrasena", getText("contrasenia.error"));
        } else if ("".equals(this.getContrasena())) {
            addFieldError("contrasena", getText("contrasenia.error"));
        }
    }

    public String execute() throws Exception {

        Usuario us = new UsuarioDAO().comprobarLogin(getUsuario(), getContrasena());
        boolean correcto = us != null;

        if (correcto) {
            
            getSESION().put("USUARIO", us);
            getSESION().put("PUNTOS", new UsuarioDAO().getPuntos(us));
            getSESION().put("N_CHOLLOS", us.getProductos().size());
            getSESION().put("N_COMENTARIOS", us.getComentarios().size());
            
            return SUCCESS;
        }
        return ERROR;
    }

    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }

    public Map<String, Object> getSESION() {
        return SESION;
    }
    
    

}
