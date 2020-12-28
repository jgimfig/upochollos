package acciones;

import com.opensymphony.xwork2.ActionSupport;
import com.opensymphony.xwork2.validator.annotations.EmailValidator;
import com.opensymphony.xwork2.validator.annotations.RequiredStringValidator;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.UsuarioDAO;
import pojos.Usuario;

public class ActualizarCorreoAction extends ActionSupport implements SessionAware {

    Map<String, Object> SESION;

    private String correo;
    private String correoContrasena;

    public String getCorreo() {
        return correo;
    }

    @EmailValidator(key = "email.error")
    @RequiredStringValidator(key = "campo.requerido")
    public void setCorreo(String correo) {
        this.correo = correo;
    }

    public String getCorreoContrasena() {
        return correoContrasena;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setCorreoContrasena(String correoContrasena) {
        this.correoContrasena = correoContrasena;
    }

    public ActualizarCorreoAction() {
    }

    @Override
    public String execute() throws Exception {

        Usuario u = (Usuario) getSESION().get("USUARIO"); // Recuperamos el usuario de la sesion

        if (u != null) { // Si el usuario tiene una sesión iniciada
                        
            // Si la contraseña coincide, se actualiza el correo.
            if (u.getHash().equals(getCorreoContrasena())) {
                u.setEmail(getCorreo());
                new UsuarioDAO().update(u);

                // Al actualizarse la contraseña, se cierra la sesión.
                getSESION().remove("CATEGORIAS");
                getSESION().remove("TIENDAS");
                getSESION().remove("CUPONES");
                getSESION().remove("ANUNCIOS");
                getSESION().remove("PATROCINADORES");

            }
        }

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
