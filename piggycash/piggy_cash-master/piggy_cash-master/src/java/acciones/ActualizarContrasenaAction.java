package acciones;

import com.opensymphony.xwork2.ActionSupport;
import com.opensymphony.xwork2.validator.annotations.RequiredStringValidator;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.UsuarioDAO;
import pojos.Usuario;

public class ActualizarContrasenaAction extends ActionSupport implements SessionAware {

    //ATRIBUTOS 
    private String contrasena, confirmaContrasena, contrasenaActual;

    Map<String, Object> SESION;

    public ActualizarContrasenaAction() {
    }

    public String getContrasena() {
        return contrasena;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setContrasena(String contrasena) {
        this.contrasena = contrasena;
    }

    public String getConfirmaContrasena() {
        return confirmaContrasena;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setConfirmaContrasena(String confirmaContrasena) {
        this.confirmaContrasena = confirmaContrasena;
    }

    public String getContrasenaActual() {
        return contrasenaActual;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setContrasenaActual(String contrasenaActual) {
        this.contrasenaActual = contrasenaActual;
    }

    @Override
    public String execute() throws Exception {

        Usuario u = (Usuario) getSESION().get("USUARIO"); // Recuperamos el usuario de la sesion

        if (u != null) { // Si el usuario tiene una sesión iniciada

            //Y si además, la contraseña anterior se corresponde con la actual y la contraseña nueva y su confirmación coinciden
            if (u.getHash().equals(getContrasenaActual()) && getContrasena().equals(getConfirmaContrasena())) {
                u.setHash(getContrasenaActual());
                new UsuarioDAO().update(u.getUsuario(), getContrasena());

                // Al actualizarse la contraseña, se cierra la sesión.
                getSESION().remove("CATEGORIAS");
                getSESION().remove("TIENDAS");
                getSESION().remove("CUPONES");
                getSESION().remove("ANUNCIOS");
                getSESION().remove("PATROCINADORES");
                return SUCCESS;
            }
        }

        return ERROR;
    }

    public Map<String, Object> getSESION() {
        return SESION;
    }

    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }

}
