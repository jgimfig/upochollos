package persistencia;

import java.util.ArrayList;
import java.util.List;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import pojos.Producto;
import pojos.Puntua;
import pojos.Usuario;

public class UsuarioDAO implements DAO<Usuario, String> {

    private Session sesion = null;

    @Override
    public void create(Usuario elemento) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }

        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            sesion.save(elemento);
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    @Override
    public void update(Usuario elemento) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            sesion.update(elemento);
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    //ACTUALIZA LA CONTRASEÑA DE UN USUARIO
    public void update(String nombreUsuario, String contrasena) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query q = sesion.createQuery("update Usuario set hash = '" + contrasena + "' where usuario = '" + nombreUsuario + "'");

            q.executeUpdate();
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    //ACTUALIZA LA FOTO DE PERFIL DE UN USUARIO
    public void updateFoto(String nombreUsuario, String filename) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query q = sesion.createQuery("update Usuario set foto = '" + filename + "' where usuario = '" + nombreUsuario + "'");
            q.executeUpdate();
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    //DADO UN USUARIO, NOS DEVUELVE LA CANTIDAD DE PUNTOS OBTENIDOS POR SUS PRODUCTOS
    public Integer getPuntos(Usuario usuario) {
        Integer c = 0;
        List<Producto> productos = new ArrayList<>();
        List<Puntua> puntuaciones = new ArrayList<>();

        productos.addAll(usuario.getProductos());

        for (Producto p : productos) {
            puntuaciones.addAll(p.getPuntuas());
        }

        for (Puntua pun : puntuaciones) {
            c += pun.getPuntuacion();
        }

        return c;
    }

    @Override
    public void delete(Usuario elemento) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();

            Query q1 = sesion.createQuery("delete from Comentario com where com.usuario.usuario = '" + elemento.getUsuario() + "'");
            Query q2 = sesion.createQuery("delete from Puntua p where p.usuario.usuario = '" + elemento.getUsuario() + "'");
            Query q3 = sesion.createQuery("delete from Producto p where p.usuario.usuario = '" + elemento.getUsuario() + "'");
            Query q4 = sesion.createQuery("delete from Usuario u where u.usuario = '" + elemento.getUsuario() + "'");

             q1.executeUpdate();
             q2.executeUpdate();
             q3.executeUpdate();
             q4.executeUpdate();
             
           
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    @Override
    public Usuario read(String primaryKey) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Usuario where usuario='" + primaryKey + "'");
            tx.commit();
            return (Usuario) query.uniqueResult();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public List<Usuario> list() {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Usuario");
            tx.commit();
            return query.list();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public List<String> listPK() {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        List<String> listaNombres = new ArrayList<>();
        List<Usuario> listaUsuarios;
        try {
            tx = sesion.beginTransaction();
            listaUsuarios = list();
            for (int i = 0; i < listaUsuarios.size(); i++) {
                listaNombres.add(listaUsuarios.get(i).getUsuario());
            }
            tx.commit();
            return listaNombres;
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    //COMPRUEBA SI LAS CREDENCIALES DE UN USUARIO SON CORRECTAS
    public Usuario comprobarLogin(String usuario, String contrasena) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = sesion.beginTransaction();
        Query q = sesion.createQuery("from Usuario where usuario = '" + usuario + "' and hash = '" + contrasena + "'");
        Usuario user = (Usuario) q.uniqueResult();
        tx.commit();
        return user;
    }
}
