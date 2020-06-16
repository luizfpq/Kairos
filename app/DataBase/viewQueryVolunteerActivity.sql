select schedule.description as name, volunteer_activity.description, volunteer_activity.time, schedule.date
from volunteer_activity, volunteer, schedule, activity
where activity.id = volunteer_activity.activity
      and schedule.id = volunteer_activity.schedule
      and volunteer.id = volunteer_activity.volunteer
      and volunteer.id = $id
      and volunteer_activity.accept = -1
order by schedule.date asc;
